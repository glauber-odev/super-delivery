<?php

namespace App\Services;

use App\Models\Pedido;
use App\Models\PedidoHistorico;
use App\Models\PedidoProduto;
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

            $carrinhos = Pedido::all();

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

            $to = $request->input('to');
            // $isPedidoProgramado = $request->input('isPedidoProgramado');

            $carrinhoSession = session('carrinho');

            $pedidoParams = $carrinhoSession;
            unset($carrinhoParams['produtos']);
            $pedido = new Pedido($pedidoParams);

            $pedido->save();


            $carrinhoProdutos = [];
            $subtotal = 0;
            foreach ($carrinhoSession['carrinho']['produtos'] as $produto) {
                $pedidoProdutos[] = [
                    'pedido_id' => $pedido->id,
                    'produto_id' => $produto->id,
                    'quantidade' => $produto->quantidade,
                ];
                $subtotal += $produto->quantidade * $produto->preco;
            }

            $carrinhoProdutos = PedidoProduto::insert($carrinhoProdutos);

            $freteData = $this->residenciaService->getFreteData(Residencia::CEP_LOJA_MATRIZ, $to);

            $custoFrete = $freteData['price'];
            $dias_estimados_entrega = $freteData['delivery_time'];

            $pedido->subtotal = $subtotal;
            $pedido->custo_frete = $custoFrete;
            $pedido->total = $subtotal + $custoFrete;
            $pedido->dias_estimados_entrega = $dias_estimados_entrega;

            $pedidoStatus = PedidoHistorico::create([
                'pedido_id' => $pedido->id,
                'pedido_satuts_id' => 1, // confirmado
            ]);

            // if($isPedidoProgramado){
            //     // pedido programado
            // }

            $pedido->save();

            session()->forget('carrinho');

            return $pedido;
        });
    }
}
