<?php

namespace App\Services;

use App\Models\PedidoProduto;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class PedidoProdutoService
{

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhoProduto = PedidoProduto::create($request);

            return $carrinhoProduto;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = PedidoProduto::all();

            if($carrinhos == null) throw new FileNotFoundException('Nenhum PedidoProduto foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinhoProduto = PedidoProduto::find($id);

            if($carrinhoProduto == null) throw new FileNotFoundException('o PedidoProduto não foi encontrado.');

            return $carrinhoProduto;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinhoProduto = PedidoProduto::where('id', $id)->update($request);

            return $carrinhoProduto;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinhoProduto = PedidoProduto::findOrFail($id);
            $carrinhoProduto->delete();

            return $carrinhoProduto;
        });
    }

}
