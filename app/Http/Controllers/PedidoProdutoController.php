<?php

namespace App\Http\Controllers;

use App\Models\PedidoProduto;
use App\Services\PedidoProdutoService;
use Illuminate\Http\Request;

class PedidoProdutoController extends Controller
{

    protected $pedidoProdutoService;

    public function __construct(PedidoProdutoService $pedidoProdutoService)
    {
        $this->pedidoProdutoService = $pedidoProdutoService;
    }

    public function create(Request $request)
    {
        try {

            $pedidoProduto = $this->pedidoProdutoService->create($request->all());

            return response()->json([
                'message' => 'Carrinho criado com sucesso.',
                'data' => $pedidoProduto,
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

            $pedidoProduto = $this->pedidoProdutoService->fetch($request->all());

            return response()->json([
                'message' => 'pedidoProduto(s) buscado(s) com sucesso.',
                'data' => $pedidoProduto,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) pedidoProduto(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function findById(Request $request, $id)
    {
        try {

            $pedidoProduto = $this->pedidoProdutoService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) buscado(s) com sucesso.',
                'data' => $pedidoProduto,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) pedidoProduto(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {

            $pedidoProduto = $this->pedidoProdutoService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) atualizado(s) com sucesso.',
                'data' => $pedidoProduto,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao atualizar o pedidoProduto.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {

            $pedidoProduto = $this->pedidoProdutoService->delete($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho exluído com sucesso.',
                'data' => $pedidoProduto,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao excluir o pedidoProduto.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
