<?php

namespace App\Http\Controllers;

use App\Services\EstadoService;
use Illuminate\Http\Request;

class EstadoController extends Controller
{

    protected $estadoService;

    public function __construct(EstadoService $estadoService) {
        $this->estadoService = $estadoService;
    }

    public function fetch(Request $request)
    {
        try {

            $carrinho = $this->estadoService->fetch($request->all());

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

            $carrinho = $this->estadoService->findById($request->all(), $id);

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
