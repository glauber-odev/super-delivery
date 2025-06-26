<?php

namespace App\Http\Controllers;

use App\Models\Residencia;
use App\Services\ResidenciaService;
use Illuminate\Http\Request;

class ResidenciaController extends Controller
{

    protected $residenciaService;

    public function __construct(ResidenciaService $residenciaService)
    {
        $this->residenciaService = $residenciaService;
    }

    public function create(Request $request)
    {
        try {

            $residencia = $this->residenciaService->create($request->all());

            return response()->json([
                'message' => 'Carrinho criado com sucesso.',
                'data' => $residencia,
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

            $residencia = $this->residenciaService->fetch($request->all());

            return response()->json([
                'message' => 'residencia(s) buscado(s) com sucesso.',
                'data' => $residencia,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) residencia(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function findById(Request $request, $id)
    {
        try {

            $residencia = $this->residenciaService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) buscado(s) com sucesso.',
                'data' => $residencia,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) residencia(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {

            $residencia = $this->residenciaService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) atualizado(s) com sucesso.',
                'data' => $residencia,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao atualizar o residencia.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {

            $residencia = $this->residenciaService->delete($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho exluído com sucesso.',
                'data' => $residencia,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao excluir o residencia.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function getFreteData(Request $request)
    {
        try {
            $to = $request->input('to');
            $residencia = $this->residenciaService->getFreteData(Residencia::CEP_LOJA_MATRIZ, $to);

            return response()->json([
                'message' => 'Dados buscados com sucesso.',
                'data' => $residencia,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar os dados o frete.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
