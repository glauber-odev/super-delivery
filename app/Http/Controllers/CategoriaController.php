<?php

namespace App\Http\Controllers;

use App\Services\CategoriaService;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    protected $categoriaService;

    public function __construct(CategoriaService $categoriaService) {
        $this->categoriaService = $categoriaService;
    }

    public function fetch(Request $request)
    {
        try {

            $carrinho = $this->categoriaService->fetch($request->all());

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

            $carrinho = $this->categoriaService->findById($request->all(), $id);

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
