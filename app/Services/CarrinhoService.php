<?php

namespace App\Services;

use App\Models\Carrinho;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class CarrinhoService
{

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

            $carrinhos = Carrinho::all();

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

}
