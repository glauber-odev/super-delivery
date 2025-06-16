<?php

namespace App\Http\Controllers;

use App\Models\ProdutoAvaliacao;
use App\Services\ProdutoAvaliacaoService;
use Illuminate\Http\Request;

class ProdutoAvaliacaoController extends Controller
{

    protected $produtoAvaliacaoService;

    public function __construct(ProdutoAvaliacaoService $produtoAvaliacaoService)
    {
        $this->produtoAvaliacaoService = $produtoAvaliacaoService;
    }

    public function create(Request $request)
    {
        try {

            $produtoAvaliacao = $this->produtoAvaliacaoService->create($request->all());

            return response()->json([
                'message' => 'Carrinho criado com sucesso.',
                'data' => $produtoAvaliacao,
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

            $produtoAvaliacao = $this->produtoAvaliacaoService->fetch($request->all());

            return response()->json([
                'message' => 'produtoAvaliacao(s) buscado(s) com sucesso.',
                'data' => $produtoAvaliacao,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) produtoAvaliacao(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function findById(Request $request, $id)
    {
        try {

            $produtoAvaliacao = $this->produtoAvaliacaoService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) buscado(s) com sucesso.',
                'data' => $produtoAvaliacao,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) produtoAvaliacao(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {

            $produtoAvaliacao = $this->produtoAvaliacaoService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) atualizado(s) com sucesso.',
                'data' => $produtoAvaliacao,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao atualizar o produtoAvaliacao.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {

            $produtoAvaliacao = $this->produtoAvaliacaoService->delete($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho exluído com sucesso.',
                'data' => $produtoAvaliacao,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao excluir o produtoAvaliacao.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
