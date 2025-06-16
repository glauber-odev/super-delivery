<?php

namespace App\Http\Controllers;

use App\Models\PedidoProgramado;
use App\Services\PedidoProgramadoService;
use Illuminate\Http\Request;

class PedidoProgramadoController extends Controller
{

    protected $pedidoProgramadoService;

    public function __construct(PedidoProgramadoService $pedidoProgramadoService)
    {
        $this->pedidoProgramadoService = $pedidoProgramadoService;
    }

    public function create(Request $request)
    {
        try {

            $pedidoProgramado = $this->pedidoProgramadoService->create($request->all());

            return response()->json([
                'message' => 'PedidoProgramado criado com sucesso.',
                'data' => $pedidoProgramado,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao criar o PedidoProgramado.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function fetch(Request $request)
    {
        try {

            $pedidoProgramado = $this->pedidoProgramadoService->fetch($request->all());

            return response()->json([
                'message' => 'pedidoProgramado(s) buscado(s) com sucesso.',
                'data' => $pedidoProgramado,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) pedidoProgramado(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function findById(Request $request, $id)
    {
        try {

            $pedidoProgramado = $this->pedidoProgramadoService->findById($request->all(), $id);

            return response()->json([
                'message' => 'PedidoProgramado(s) buscado(s) com sucesso.',
                'data' => $pedidoProgramado,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) pedidoProgramado(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {

            $pedidoProgramado = $this->pedidoProgramadoService->findById($request->all(), $id);

            return response()->json([
                'message' => 'PedidoProgramado(s) atualizado(s) com sucesso.',
                'data' => $pedidoProgramado,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao atualizar o pedidoProgramado.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {

            $pedidoProgramado = $this->pedidoProgramadoService->delete($request->all(), $id);

            return response()->json([
                'message' => 'PedidoProgramado exluído com sucesso.',
                'data' => $pedidoProgramado,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao excluir o pedidoProgramado.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
