<?php

namespace App\Services;

use App\Models\Categoria;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class CategoriaService
{

    // public function create($request)
    // {
    //     return DB::transaction(function () use ($request) {

    //         $carrinho = Categoria::create($request);

    //         return $carrinho;
    //     });
    // }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = Categoria::all();

            if($carrinhos == null) throw new FileNotFoundException('Nenhum Categoria foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Categoria::find($id);

            if($carrinho == null) throw new FileNotFoundException('o Categoria não foi encontrado.');

            return $carrinho;
        });
    }

    // public function update($request, $id)
    // {
    //     return DB::transaction(function () use ($request, $id) {

    //         $carrinho = Categoria::where('id', $id)->update($request);

    //         return $carrinho;
    //     });
    // }

    // public function delete($request, $id)
    // {
    //     return DB::transaction(function () use ($request, $id) {

    //         $carrinho = Categoria::findOrFail($id);
    //         $carrinho->delete();

    //         return $carrinho;
    //     });
    // }

}
