<?php

namespace App\Services;

use App\Models\Pedido;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class PedidoService
{

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinho = Pedido::create($request);

            return $carrinho;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = Pedido::all();

            if($carrinhos == null) throw new FileNotFoundException('Nenhum Pedido foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Pedido::find($id);

            if($carrinho == null) throw new FileNotFoundException('o Pedido não foi encontrado.');

            return $carrinho;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Pedido::where('id', $id)->update($request);

            return $carrinho;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = Pedido::findOrFail($id);
            $carrinho->delete();

            return $carrinho;
        });
    }

}
