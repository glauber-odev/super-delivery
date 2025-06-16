<?php

namespace App\Http\Controllers;

use App\Services\CarrinhoService;
use Illuminate\Http\Request;

class TempoUnidadeController extends Controller
{

    protected $tempoUnidadeService;

    public function __construct(CarrinhoService $tempoUnidadeService) {
        $this->tempoUnidadeService = $tempoUnidadeService;
    }

    public function fetch(Request $request)
    {
        try {

            $carrinho = $this->tempoUnidadeService->fetch($request->all());

            return response()->json([
                'message' => 'carrinho(s) buscado(s) com sucesso.',
                'data' => $carrinho,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) carrinho(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function findById(Request $request, $id)
    {
        try {

            $carrinho = $this->tempoUnidadeService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) buscado(s) com sucesso.',
                'data' => $carrinho,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) carrinho(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
