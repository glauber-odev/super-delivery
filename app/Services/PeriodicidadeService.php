<?php

namespace App\Services;

use App\Models\Periodicidade;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class PeriodicidadeService
{

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinho = Periodicidade::create($request);

            return $carrinho;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = Periodicidade::all();

            if($carrinhos == null) throw new FileNotFoundException('Nenhum Periodicidade foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Periodicidade::find($id);

            if($carrinho == null) throw new FileNotFoundException('o Periodicidade não foi encontrado.');

            return $carrinho;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Periodicidade::where('id', $id)->update($request);

            return $carrinho;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Periodicidade::findOrFail($id);
            $carrinho->delete();

            return $carrinho;
        });
    }

}
