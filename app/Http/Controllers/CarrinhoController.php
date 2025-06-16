<?php

namespace App\Http\Controllers;

use App\Services\CarrinhoService;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{

    protected $carrinhoService;

    public function __construct(CarrinhoService $carrinhoService)
    {
        $this->carrinhoService = $carrinhoService;
    }

    public function create(Request $request)
    {
        try {

            $carrinho = $this->carrinhoService->create($request->all());

            return response()->json([
                'message' => 'Carrinho criado com sucesso.',
                'data' => $carrinho,
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

            $carrinho = $this->carrinhoService->fetch($request->all());

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

            $carrinho = $this->carrinhoService->findById($request->all(), $id);

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


    public function update(Request $request, $id)
    {
        try {

            $carrinho = $this->carrinhoService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) atualizado(s) com sucesso.',
                'data' => $carrinho,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao atualizar o carrinho.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {

            $carrinho = $this->carrinhoService->delete($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho exluído com sucesso.',
                'data' => $carrinho,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao excluir o carrinho.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

}
