<?php

namespace App\Http\Controllers;

use App\Models\PedidoStatus;
use Illuminate\Http\Request;

class PedidoStatusController extends Controller
{

    protected $pedidoStatusService;

    public function __construct(PedidoStatus $pedidoStatusService) {
        $this->pedidoStatusService = $pedidoStatusService;
    }

    public function fetch(Request $request)
    {
        try {

            $carrinho = $this->pedidoStatusService->fetch($request->all());

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

            $carrinho = $this->pedidoStatusService->findById($request->all(), $id);

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
