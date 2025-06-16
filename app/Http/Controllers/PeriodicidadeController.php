<?php

namespace App\Http\Controllers;

use App\Models\Periodicidade;
use App\Services\PeriodicidadeService;
use Illuminate\Http\Request;

class PeriodicidadeController extends Controller
{

    protected $periodicidadeService;

    public function __construct(PeriodicidadeService $periodicidadeService)
    {
        $this->periodicidadeService = $periodicidadeService;
    }

    public function create(Request $request)
    {
        try {

            $periodicidade = $this->periodicidadeService->create($request->all());

            return response()->json([
                'message' => 'Carrinho criado com sucesso.',
                'data' => $periodicidade,
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

            $periodicidade = $this->periodicidadeService->fetch($request->all());

            return response()->json([
                'message' => 'periodicidade(s) buscado(s) com sucesso.',
                'data' => $periodicidade,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) periodicidade(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function findById(Request $request, $id)
    {
        try {

            $periodicidade = $this->periodicidadeService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) buscado(s) com sucesso.',
                'data' => $periodicidade,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) periodicidade(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {

            $periodicidade = $this->periodicidadeService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) atualizado(s) com sucesso.',
                'data' => $periodicidade,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao atualizar o periodicidade.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {

            $periodicidade = $this->periodicidadeService->delete($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho exluído com sucesso.',
                'data' => $periodicidade,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao excluir o periodicidade.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
