<?php

namespace App\Services;

use App\Models\PedidoStatus;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class PedidoStatusService
{

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinho = PedidoStatus::create($request);

            return $carrinho;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = PedidoStatus::all();

            if($carrinhos == null) throw new FileNotFoundException('Nenhum Status de pedido foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = PedidoStatus::find($id);

            if($carrinho == null) throw new FileNotFoundException('o Status de pedido não foi encontrado.');

            return $carrinho;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = PedidoStatus::where('id', $id)->update($request);

            return $carrinho;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = PedidoStatus::findOrFail($id);
            $carrinho->delete();

            return $carrinho;
        });
    }

}
