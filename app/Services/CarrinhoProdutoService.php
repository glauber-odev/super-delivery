<?php

namespace App\Services;

use App\Models\CarrinhoProduto;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class CarrinhoProdutoService
{

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhoProdutoSession = session(
                [['carrinho']['produtos'] => [
                    ['id' => 1],
                    ['id' => 2],
                ]]
            );

            dd($carrinhoProdutoSession);

            // $carrinhoProduto = CarrinhoProduto::create($request);

            return $carrinhoProduto;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $carrinhos = CarrinhoProduto::all();

            if($carrinhos == null) throw new FileNotFoundException('Nenhum CarrinhoProduto foi encontrado.');

            return $carrinhos;
        });
    }

    public function findById($request, $id)
    {

        return DB::transaction(function () use ($request, $id) {

            $carrinhoProduto = CarrinhoProduto::find($id);

            if($carrinhoProduto == null) throw new FileNotFoundException('o CarrinhoProduto não foi encontrado.');

            return $carrinhoProduto;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinhoProduto = CarrinhoProduto::where('id', $id)->update($request);

            return $carrinhoProduto;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $carrinhoProduto = CarrinhoProduto::findOrFail($id);
            $carrinhoProduto->delete();

            return $carrinhoProduto;
        });
    }
    
    public function findByCarrinhoAndProdutoId($request, $idProduto)
    {

        return DB::transaction(function () use ($request, $idProduto) {

            $carrinhoProduto = CarrinhoProduto::where('produto_id', $idProduto);

            if($carrinhoProduto == null) throw new FileNotFoundException('o CarrinhoProduto não foi encontrado.');

            return $carrinhoProduto;
        });
    }
}
