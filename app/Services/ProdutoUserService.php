<?php

namespace App\Services;

use App\Models\ProdutoUser;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class ProdutoUserService
{

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinho = ProdutoUser::create($request);

            return $carrinho;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = ProdutoUser::all();

            if($carrinhos == null) throw new FileNotFoundException('Nenhum ProdutoUser foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = ProdutoUser::find($id);

            if($carrinho == null) throw new FileNotFoundException('o ProdutoUser não foi encontrado.');

            return $carrinho;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = ProdutoUser::where('id', $id)->update($request);

            return $carrinho;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = ProdutoUser::findOrFail($id);
            $carrinho->delete();

            return $carrinho;
        });
    }

}
