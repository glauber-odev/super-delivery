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

            $produtoImagem = ProdutoImagem::create($request);

            return $produtoImagem;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $produtoImagems = ProdutoImagem::all();

            if($produtoImagems == null) throw new FileNotFoundException('Nenhum ProdutoImagem foi encontrado.');

            return $produtoImagems;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $produtoImagem = ProdutoImagem::find($id);

            if($produtoImagem == null) throw new FileNotFoundException('o ProdutoImagem não foi encontrado.');

            return $produtoImagem;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $produtoImagem = ProdutoImagem::where('id', $id)->update($request);

            return $produtoImagem;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $produtoImagem = ProdutoImagem::findOrFail($id);
            $produtoImagem->delete();

            return $produtoImagem;
        });
    }

}
