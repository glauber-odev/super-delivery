<?php

namespace App\Http\Controllers;

use App\Services\ImagemService;
use Illuminate\Http\Request;

class ImagemController extends Controller
{

    protected $imagemService;

    public function __construct(ImagemService $imagemService)
    {
        $this->imagemService = $imagemService;
    }

    public function create(Request $request)
    {
        try {

            $imagem = $this->imagemService->create($request->all());

            return response()->json([
                'message' => 'Carrinho criado com sucesso.',
                'data' => $imagem,
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

            $imagem = $this->imagemService->fetch($request->all());

            return response()->json([
                'message' => 'imagem(s) buscado(s) com sucesso.',
                'data' => $imagem,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) imagem(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function findById(Request $request, $id)
    {
        try {

            $imagem = $this->imagemService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) buscado(s) com sucesso.',
                'data' => $imagem,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao buscar o(s) imagem(s).',
                'details' => $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {

            $imagem = $this->imagemService->findById($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho(s) atualizado(s) com sucesso.',
                'data' => $imagem,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao atualizar o imagem.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request, $id)
    {
        try {

            $imagem = $this->imagemService->delete($request->all(), $id);

            return response()->json([
                'message' => 'Carrinho exluído com sucesso.',
                'data' => $imagem,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao excluir o imagem.',
                'details' => $e->getMessage()
            ], 500);
        }
    }
}
