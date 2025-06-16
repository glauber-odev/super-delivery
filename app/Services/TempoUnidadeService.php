<?php

namespace App\Services;

use App\Models\TempoUnidade;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class TempoUnidadeService
{

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinho = TempoUnidade::create($request);

            return $carrinho;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = TempoUnidade::all();

            if($carrinhos == null) throw new FileNotFoundException('Nenhuma unidade de tempo foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = TempoUnidade::find($id);

            if($carrinho == null) throw new FileNotFoundException('A unidade de tempo não foi encontrado.');

            return $carrinho;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = TempoUnidade::where('id', $id)->update($request);

            return $carrinho;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = TempoUnidade::findOrFail($id);
            $carrinho->delete();

            return $carrinho;
        });
    }

}
