<?php

namespace App\Services;

use App\Models\Residencia;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class ResidenciaService
{

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinho = Residencia::create($request);

            return $carrinho;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = Residencia::all();

            if($carrinhos == null) throw new FileNotFoundException('Nenhum Residencia foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Residencia::find($id);

            if($carrinho == null) throw new FileNotFoundException('o Residencia não foi encontrado.');

            return $carrinho;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Residencia::where('id', $id)->update($request);

            return $carrinho;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Residencia::findOrFail($id);
            $carrinho->delete();

            return $carrinho;
        });
    }

}
