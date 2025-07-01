<?php

namespace App\Services;

use App\Models\Carrinho;
use App\Models\CarrinhoProduto;
use App\Models\Pedido;
use App\Models\PedidoHistorico;
use App\Models\PedidoProduto;
use App\Models\PedidoProgramado;
use App\Models\Produto;
use App\Models\Residencia;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class PedidoService
{

    protected $residenciaService;

    public function __construct(ResidenciaService $residenciaService)
    {
        $this->residenciaService = $residenciaService;
    }

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinho = Pedido::create($request);

            return $carrinho;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = Pedido::with(['pedidoProdutos.produto.produtoImagem.imagens', 'residencia'])->get();

            if ($carrinhos == null) throw new FileNotFoundException('Nenhum Pedido foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Pedido::find($id);

            if ($carrinho == null) throw new FileNotFoundException('o Pedido não foi encontrado.');

            return $carrinho;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Pedido::where('id', $id)->update($request);

            return $carrinho;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Pedido::findOrFail($id);
            $carrinho->delete();

            return $carrinho;
        });
    }

    public function createByCarrinhoSession($request)
    {
        return DB::transaction(function () use ($request) {

            $isPedidoProgramado = $request->input('flg_habilitado');
            $residenciaId = $request->input('residencia_id');
            $userId = $request->input('user_id');
            $carrinhoSession = session('carrinho');
            $carrinhoId = $carrinhoSession['id'] ?? null;
            
            $to = Residencia::where('id', $residenciaId)->pluck('cep')->first();
            
            $pedidoParams = $carrinhoSession;
            $pedidoParams['flg_pago'] = true;
            $pedidoParams['flg_retirar_na_loja'] = false;
            $pedidoParams['residencia_id'] = $residenciaId;
            unset($pedidoParams['produtos']);
            $pedido = new Pedido($pedidoParams);

            $pedido->save();


            $pedidoProdutos = [];
            $subTotal = 0;
            foreach ($carrinhoSession['produtos'] as $produto) {
                $produtoData = Produto::find($produto['produto_id']);
                $pedidoProdutos[] = [
                    'pedido_id' => $pedido->id,
                    'produto_id' => $produto['produto_id'],
                    'quantidade' => $produto['quantidade'],
                ];
                $subTotal += $produto['quantidade'] * $produtoData->preco;
            }

            $carrinhoProdutos = PedidoProduto::insert($pedidoProdutos);

            $freteData = $this->residenciaService->getFreteData(Residencia::CEP_LOJA_MATRIZ, $to);

            $custoFrete = $freteData['price'];
            $dias_estimados_entrega = $freteData['delivery_time'];

            $pedido->user_id = $userId;
            $pedido->custo_frete = $custoFrete;
            $pedido->subtotal = $subTotal;
            $pedido->total = $pedido->subtotal + $pedido->custo_frete;
            $pedido->dias_estimados_entrega = $dias_estimados_entrega;

            $pedidoHistoricoStatus = PedidoHistorico::create([
                'pedido_id' => $pedido->id,
                'pedidos_status_id' => 1, // confirmado
            ]);

            //create from carrinho ID ou create from carrinhoSession
            if($isPedidoProgramado){

                if(!$carrinhoId){
                    $carrinho = new Carrinho();
                    $carrinho->user_id = $userId;
                    $carrinho->residencia_id = $residenciaId;
                    $carrinho->save();
                    $carrinhoId = $carrinho->id;

                    $carrinhoProdutos = [];
                    $total = 0;
                    foreach ($carrinhoSession['produtos'] as $produto) {
                        $produtoData = Produto::find($produto['produto_id']);
                        $carrinhoProdutos[] = [
                            'carrinho_id' => $carrinho->id,
                            'produto_id' => $produto['produto_id'],
                            'quantidade' => $produto['quantidade'],
                        ];
                        $total += $produto['quantidade'] * $produtoData->preco;
                    }

                    $carrinhoProdutos = CarrinhoProduto::insert($carrinhoProdutos);

                    $carrinho->total = $total;
                    $carrinho->save();
                }


                $pedidoProgramadoParams = $request->only([
                    'flg_habilitado',
                    'flg_debito_automatico',
                    'periodicidade_id',
                    'tempo_unidade_id',
                ]);

                $pedidoProgramado = new PedidoProgramado($pedidoProgramadoParams);
                $pedidoProgramado->user_id = $userId;
                $pedidoProgramado->carrinho_id = $carrinhoId;
                $pedidoProgramado->save();
                
            };

            $pedido->save();

            session()->forget('carrinho');

            return $pedido;
        });
    }
}
