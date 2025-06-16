<?php

namespace App\Http\Controllers;

use App\Models\ProdutoImagem;
use App\Services\ProdutoImagemService;
use Illuminate\Http\Request;

class ProdutoImagemController extends Controller
{

    protected $produtoImagemService;

    public function __construct(ProdutoImagemService $produtoImagemService)
    {
        $this->produtoImagemService = $produtoImagemService;
    }

    public function create(Request $request)
    {
        try {

            $produtoImagem = $this->produtoImagemService->create($request->all());

            return response()->json([
                'message' => 'Carrinho criado com sucesso.',
                'data' => $produtoImagem,
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

            $produtoImagem = $this->produtoImagemService->fetch($request->all());

            return response()->json([
                'message' => 'produtoImagem(s) buscado(s) com sucesso.',
                'data' => $produtoImagem,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) produtoImagem(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function findById(Request $request, $id)
    {
        try {

            $produtoImagem = $this->produtoImagemService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) buscado(s) com sucesso.',
                'data' => $produtoImagem,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) produtoImagem(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {

            $produtoImagem = $this->produtoImagemService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) atualizado(s) com sucesso.',
                'data' => $produtoImagem,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao atualizar o produtoImagem.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {

            $produtoImagem = $this->produtoImagemService->delete($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho exluído com sucesso.',
                'data' => $produtoImagem,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao excluir o produtoImagem.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
