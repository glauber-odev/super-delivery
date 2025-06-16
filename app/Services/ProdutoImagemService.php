<?php

namespace App\Services;

use App\Models\ProdutoImagem;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class ProdutoImagemService
{

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinho = ProdutoImagem::create($request);

            return $carrinho;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = ProdutoImagem::all();

            if($carrinhos == null) throw new FileNotFoundException('Nenhum ProdutoImagem foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = ProdutoImagem::find($id);

            if($carrinho == null) throw new FileNotFoundException('o ProdutoImagem não foi encontrado.');

            return $carrinho;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = ProdutoImagem::where('id', $id)->update($request);

            return $carrinho;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = ProdutoImagem::findOrFail($id);
            $carrinho->delete();

            return $carrinho;
        });
    }

}
