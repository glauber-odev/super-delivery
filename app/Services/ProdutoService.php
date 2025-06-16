<?php

namespace App\Services;

use App\Models\Produto;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class ProdutoService
{

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinho = Produto::create($request);

            return $carrinho;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = Produto::all();

            if($carrinhos == null) throw new FileNotFoundException('Nenhum Produto foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Produto::find($id);

            if($carrinho == null) throw new FileNotFoundException('o Produto não foi encontrado.');

            return $carrinho;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Produto::where('id', $id)->update($request);

            return $carrinho;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Produto::findOrFail($id);
            $carrinho->delete();

            return $carrinho;
        });
    }

}
