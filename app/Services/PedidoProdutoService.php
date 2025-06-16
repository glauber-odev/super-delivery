<?php

namespace App\Services;

use App\Models\PedidoProduto;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class PedidoProdutoService
{

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinho = PedidoProduto::create($request);

            return $carrinho;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = PedidoProduto::all();

            if($carrinhos == null) throw new FileNotFoundException('Nenhum PedidoProduto foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = PedidoProduto::find($id);

            if($carrinho == null) throw new FileNotFoundException('o PedidoProduto não foi encontrado.');

            return $carrinho;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = PedidoProduto::where('id', $id)->update($request);

            return $carrinho;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = PedidoProduto::findOrFail($id);
            $carrinho->delete();

            return $carrinho;
        });
    }

}
