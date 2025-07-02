<?php

namespace App\Services;

use App\Models\Categoria;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;

class CategoriaService
{

    // public function create($request)
    // {
    //     return DB::transaction(function () use ($request) {

    //         $categoria = Categoria::create($request);

    //         return $categoria;
    //     });
    // }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $categorias = Categoria::all();

            if($categorias == null) throw new FileNotFoundException('Nenhum Categoria foi encontrado.');

            return $categorias;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $categoria = Categoria::find($id);

            if($categoria == null) throw new FileNotFoundException('a Categoria não foi encontrado.');

            return $categoria;
        });
    }

    // public function update($request, $id)
    // {
    //     return DB::transaction(function () use ($request, $id) {

    //         $categoria = Categoria::where('id', $id)->update($request);

    //         return $categoria;
    //     });
    // }

    // public function delete($request, $id)
    // {
    //     return DB::transaction(function () use ($request, $id) {

    //         $categoria = Categoria::findOrFail($id);
    //         $categoria->delete();

    //         return $categoria;
    //     });
    // }

}
