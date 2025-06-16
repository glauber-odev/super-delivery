<?php

namespace App\Services;

use App\Models\PedidoHistorico;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class PedidoHistoricoService
{

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinho = PedidoHistorico::create($request);

            return $carrinho;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = PedidoHistorico::all();

            if($carrinhos == null) throw new FileNotFoundException('Nenhum PedidoHistorico foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = PedidoHistorico::find($id);

            if($carrinho == null) throw new FileNotFoundException('o PedidoHistorico não foi encontrado.');

            return $carrinho;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = PedidoHistorico::where('id', $id)->update($request);

            return $carrinho;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = PedidoHistorico::findOrFail($id);
            $carrinho->delete();

            return $carrinho;
        });
    }

}
