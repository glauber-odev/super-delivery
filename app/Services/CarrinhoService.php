<?php

namespace App\Services;

use App\Models\Carrinho;
use App\Models\CarrinhoProduto;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class CarrinhoService
{

    protected $carrinhoProduto;

    public function __construct(CarrinhoProdutoService $carrinhoProduto) {
        $this->carrinhoProduto = $carrinhoProduto;
    }

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinho = Carrinho::create($request);

            return $carrinho;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = Carrinho::with([
                'residencia',
                'pedidoProgramado',
                'carrinhoProdutos.produto.produtoImagem.imagens'
                ])->get();

            if($carrinhos == null) throw new FileNotFoundException('Nenhum Carrinho foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Carrinho::find($id);

            if($carrinho == null) throw new FileNotFoundException('o Carrinho não foi encontrado.');

            return $carrinho;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Carrinho::where('id', $id)->update($request);

            return $carrinho;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Carrinho::findOrFail($id);
            $carrinho->delete();

            return $carrinho;
        });
    }

    public function addOrEditProdutosByCarrinhoId($request, $id, $idProduto)
    {
        return DB::transaction(function () use ($request, $id, $idProduto) {

            $quantidade = $request->input('quantidade');

            $carrinhoProduto = $this->carrinhoProduto->findByCarrinhoAndProdutoId(null, $id, $idProduto) ?? new CarrinhoProduto();
            $carrinhoProduto->quantidade = $quantidade;

            $carrinhoProduto->save();            

            return $carrinhoProduto;
        });
    }

    public function attachOrUpdateProdutoByCarrinhoId($request, $id, $idProduto)
    {
        return DB::transaction(function () use ($request, $id, $idProduto) {

            $quantidade = $request->input('quantidade');

            $carrinhoProduto = $this->carrinhoProduto->findByCarrinhoAndProdutoId(null, $id, $idProduto) ?? new CarrinhoProduto();
            $carrinhoProduto->quantidade = $quantidade;

            if($quantidade == 0){
                $carrinhoProduto->delete();                
            } else {
                $carrinhoProduto->save();
            }

            return $carrinhoProduto;
        });
    }

}
