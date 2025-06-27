<?php

namespace App\Services;

use App\Models\Estado;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class EstadoService
{

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinho = Estado::create($request);

            return $carrinho;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = Estado::all();

            if($carrinhos == null) throw new FileNotFoundException('Nenhum Estado foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Estado::find($id);

            if($carrinho == null) throw new FileNotFoundException('o Estado não foi encontrado.');

            return $carrinho;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Estado::where('id', $id)->update($request);

            return $carrinho;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Estado::findOrFail($id);
            $carrinho->delete();

            return $carrinho;
        });
    }

    public function findBySigla($sigla)
    {
        return DB::transaction(function () use ($sigla) {

            $carrinho = Estado::where('sigla', $sigla)->first();

            if($carrinho == null) throw new FileNotFoundException('o Estado não foi encontrado.');

            return $carrinho;
            
        });
    }

}
