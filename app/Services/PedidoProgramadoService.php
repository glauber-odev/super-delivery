<?php

namespace App\Services;

use App\Models\PedidoProgramado;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class PedidoProgramadoService
{

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinho = PedidoProgramado::create($request);

            return $carrinho;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = PedidoProgramado::all();

            if($carrinhos == null) throw new FileNotFoundException('Nenhum PedidoProgramado foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = PedidoProgramado::find($id);

            if($carrinho == null) throw new FileNotFoundException('o PedidoProgramado não foi encontrado.');

            return $carrinho;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = PedidoProgramado::where('id', $id)->update($request);

            return $carrinho;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinho = PedidoProgramado::findOrFail($id);
            $carrinho->delete();

            return $carrinho;
        });
    }

}
