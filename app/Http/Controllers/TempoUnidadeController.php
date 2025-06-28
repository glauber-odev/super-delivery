<?php

namespace App\Http\Controllers;

use App\Services\TempoUnidadeService;
use Illuminate\Http\Request;

class TempoUnidadeController extends Controller
{

    protected $tempoUnidadeService;

    public function __construct(TempoUnidadeService $tempoUnidadeService) {
        $this->tempoUnidadeService = $tempoUnidadeService;
    }

    public function fetch(Request $request)
    {
        try {

            $tempoUnidade = $this->tempoUnidadeService->fetch($request->all());

            return response()->json([
                'message' => 'tempoUnidade(s) buscado(s) com sucesso.',
                'data' => $tempoUnidade,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) tempoUnidade(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function findById(Request $request, $id)
    {
        try {

            $tempoUnidade = $this->tempoUnidadeService->findById($request->all(), $id);

            return response()->json([
                'message' => 'TempoUnidades(s) buscado(s) com sucesso.',
                'data' => $tempoUnidade,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) tempoUnidade(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
