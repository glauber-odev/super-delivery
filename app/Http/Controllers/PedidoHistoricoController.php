<?php

namespace App\Http\Controllers;

use App\Models\PedidoHistorico;
use App\Services\PedidoHistoricoService;
use Illuminate\Http\Request;

class PedidoHistoricoController extends Controller
{

    protected $pedidoHistoricoService;

    public function __construct(PedidoHistoricoService $pedidoHistoricoService)
    {
        $this->pedidoHistoricoService = $pedidoHistoricoService;
    }

    public function create(Request $request)
    {
        try {

            $pedidoHistorico = $this->pedidoHistoricoService->create($request->all());

            return response()->json([
                'message' => 'Carrinho criado com sucesso.',
                'data' => $pedidoHistorico,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao criar o Carrinho.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function fetch(Request $request)
    {
        try {

            $pedidoHistorico = $this->pedidoHistoricoService->fetch($request->all());

            return response()->json([
                'message' => 'pedidoHistorico(s) buscado(s) com sucesso.',
                'data' => $pedidoHistorico,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) pedidoHistorico(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function findById(Request $request, $id)
    {
        try {

            $pedidoHistorico = $this->pedidoHistoricoService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) buscado(s) com sucesso.',
                'data' => $pedidoHistorico,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) pedidoHistorico(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {

            $pedidoHistorico = $this->pedidoHistoricoService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) atualizado(s) com sucesso.',
                'data' => $pedidoHistorico,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao atualizar o pedidoHistorico.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {

            $pedidoHistorico = $this->pedidoHistoricoService->delete($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho exluído com sucesso.',
                'data' => $pedidoHistorico,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao excluir o pedidoHistorico.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
