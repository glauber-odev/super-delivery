<?php

namespace App\Services;

use App\Models\Imagem;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class ImagemService
{

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinho = Imagem::create($request);

            return $carrinho;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = Imagem::all();

            if($carrinhos == null) throw new FileNotFoundException('Nenhum Imagem foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Imagem::find($id);

            if($carrinho == null) throw new FileNotFoundException('o Imagem não foi encontrado.');

            return $carrinho;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Imagem::where('id', $id)->update($request);

            return $carrinho;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Imagem::findOrFail($id);
            $carrinho->delete();

            return $carrinho;
        });
    }

}
