<?php

namespace App\Services;

use App\Models\ProdutoAvaliacao;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class ProdutoAvaliacaoService
{

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinho = ProdutoAvaliacao::create($request);

            return $carrinho;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = ProdutoAvaliacao::all();

            if($carrinhos == null) throw new FileNotFoundException('Nenhum ProdutoAvaliacao foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = ProdutoAvaliacao::find($id);

            if($carrinho == null) throw new FileNotFoundException('o ProdutoAvaliacao não foi encontrado.');

            return $carrinho;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = ProdutoAvaliacao::where('id', $id)->update($request);

            return $carrinho;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = ProdutoAvaliacao::findOrFail($id);
            $carrinho->delete();

            return $carrinho;
        });
    }

}
