<?php

namespace App\Http\Controllers;

use App\Services\ProdutoService;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    protected $produtoService;

    public function __construct(ProdutoService $produtoService)
    {
        $this->produtoService = $produtoService;
    }

    public function create(Request $request)
    {
        try {

            $produto = $this->produtoService->create($request);

            return response()->json([
                'message' => 'Produto criado com sucesso.',
                'data' => $produto,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao criar o Produto.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function fetch(Request $request)
    {
        try {

            $produto = $this->produtoService->fetch($request->all());

            return response()->json([
                'message' => 'produto(s) buscado(s) com sucesso.',
                'data' => $produto,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) produto(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function findById(Request $request, $id)
    {
        try {

            $produto = $this->produtoService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Produto(s) buscado(s) com sucesso.',
                'data' => $produto,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) produto(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {

            $produto = $this->produtoService->update($request, $id);

            return response()->json([
                'message' => 'Produto(s) atualizado(s) com sucesso.',
                'data' => $produto,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao atualizar o produto.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {

            $produto = $this->produtoService->delete($request->all(), $id);

            return response()->json([
                'message' => 'Produto exluído com sucesso.',
                'data' => $produto,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao excluir o produto.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
