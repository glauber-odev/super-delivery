<?php

namespace App\Http\Controllers;

use App\Models\CarrinhoProduto;
use App\Services\CarrinhoProdutoService;
use Illuminate\Http\Request;

class CarrinhoProdutoController extends Controller
{

    protected $carrinhoProdutoService;

    public function __construct(CarrinhoProdutoService $carrinhoProdutoService)
    {
        $this->carrinhoProdutoService = $carrinhoProdutoService;
    }

    public function create(Request $request)
    {
        try {

            $carrinhoProduto = $this->carrinhoProdutoService->create($request->all());

            return response()->json([
                'message' => 'Carrinho criado com sucesso.',
                'data' => $carrinhoProduto,
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

            $carrinhoProduto = $this->carrinhoProdutoService->fetch($request->all());

            return response()->json([
                'message' => 'carrinhoProduto(s) buscado(s) com sucesso.',
                'data' => $carrinhoProduto,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) carrinhoProduto(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function findById(Request $request, $id)
    {
        try {

            $carrinhoProduto = $this->carrinhoProdutoService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) buscado(s) com sucesso.',
                'data' => $carrinhoProduto,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) carrinhoProduto(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {

            $carrinhoProduto = $this->carrinhoProdutoService->update($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) atualizado(s) com sucesso.',
                'data' => $carrinhoProduto,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao atualizar o carrinhoProduto.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {

            $carrinhoProduto = $this->carrinhoProdutoService->delete($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho exluído com sucesso.',
                'data' => $carrinhoProduto,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao excluir o carrinhoProduto.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

}
