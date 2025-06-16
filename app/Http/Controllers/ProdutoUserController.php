<?php

namespace App\Http\Controllers;

use App\Models\ProdutoUser;
use App\Services\ProdutoUserService;
use Illuminate\Http\Request;

class ProdutoUserController extends Controller
{

    protected $produtoUserService;

    public function __construct(ProdutoUserService $produtoUserService)
    {
        $this->produtoUserService = $produtoUserService;
    }

    public function create(Request $request)
    {
        try {

            $produtoUser = $this->produtoUserService->create($request->all());

            return response()->json([
                'message' => 'Carrinho criado com sucesso.',
                'data' => $produtoUser,
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

            $produtoUser = $this->produtoUserService->fetch($request->all());

            return response()->json([
                'message' => 'produtoUser(s) buscado(s) com sucesso.',
                'data' => $produtoUser,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) produtoUser(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function findById(Request $request, $id)
    {
        try {

            $produtoUser = $this->produtoUserService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) buscado(s) com sucesso.',
                'data' => $produtoUser,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) produtoUser(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {

            $produtoUser = $this->produtoUserService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) atualizado(s) com sucesso.',
                'data' => $produtoUser,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao atualizar o produtoUser.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {

            $produtoUser = $this->produtoUserService->delete($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho exluído com sucesso.',
                'data' => $produtoUser,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao excluir o produtoUser.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
