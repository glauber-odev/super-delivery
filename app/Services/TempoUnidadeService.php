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

            $tempoUnidade = TempoUnidade::create($request);

            return $tempoUnidade;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $tempoUnidades = TempoUnidade::all();

            if($tempoUnidades == null) throw new FileNotFoundException('Nenhuma unidade de tempo foi encontrado.');

            return $tempoUnidades;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $tempoUnidade = TempoUnidade::find($id);

            if($tempoUnidade == null) throw new FileNotFoundException('A unidade de tempo não foi encontrado.');

            return $tempoUnidade;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $tempoUnidade = TempoUnidade::where('id', $id)->update($request);

            return $tempoUnidade;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $tempoUnidade = TempoUnidade::findOrFail($id);
            $tempoUnidade->delete();

            return $tempoUnidade;
        });
    }

}
