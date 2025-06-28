<?php

namespace App\Http\Controllers;

use App\Models\CarrinhoProduto;
use App\Models\Produto;
use App\Services\CarrinhoService;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function addOrEditProduto(Request $request, $produtoId)
    {

        $quantidade = $request->input('quantidade');


        if (session()->has("carrinho")) {
            $carrinhoSession['carrinho'] = session("carrinho");
        } else {
            $carrinhoSession['carrinho'] = [];
        }

        $produtos = isset($carrinhoSession['carrinho']['produtos']) ?  $carrinhoSession['carrinho']['produtos'] : [];


        $carrinhoProduto = new CarrinhoProduto(['produto_id' => $produtoId, 'quantidade' => $quantidade,]);
        $produtoExiste = false;
        foreach ($produtos as $index => $produto) {

            if (isset($produto['produto_id']) && $produto['produto_id'] == $produtoId) {
                $produtoExiste = true;
                // Remove
                if ($quantidade == 0) {
                    unset($produtos[$index]);
                    unset($carrinhoSession['carrinho']['produtos'][$index]);
                // Edit
                } else {

                    $carrinhoSession['carrinho']['produtos'][$index] = $carrinhoProduto;
                }
                break; // Sai do loop se encontrou
            }

        }

        // Add
        if (!$produtoExiste) {
            $carrinhoSession['carrinho']['produtos'][] = $carrinhoProduto;
        }
        $produtos = $carrinhoSession['carrinho']['produtos'];

        // Carrega saída
        $total = 0;
        foreach ($produtos as $index => $produto) {
            $produtoResponse = Produto::with('produtoImagem.imagens')->find($produto['produto_id']);
            $produtoResponse['quantidade'] = $carrinhoSession['carrinho']['produtos'][$index]['quantidade'];
            $produtos[$index] = $produtoResponse;
            $total += $produtos[$index]['quantidade'] * $produtos[$index]['preco'];
        }

        $carrinhoSession['carrinho']['total'] = $total;
        $carrinhoResponse = $carrinhoSession;

        session(['carrinho' => $carrinhoSession['carrinho']]);

        $carrinhoResponse['carrinho']['produtos'] = array_values($produtos);

        return $carrinhoResponse;
    }


    public function attachOrUpdateProdutoByCarrinhoId(Request $request, string $id, string $idProduto)
    {
        try {

            $carrinho = $this->carrinhoService->attachOrUpdateProdutoByCarrinhoId($request, $id, $idProduto);

            return response()->json([
                'message' => 'Produto atribuído com sucesso.',
                'data' => $carrinho,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Erro ao criar o Produto.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function getProdutosFromCarrinhoSession($request = null){


        if (session()->has("carrinho")) {
            $carrinhoSession['carrinho'] = session("carrinho");
        } else {
            throw new NotFoundHttpException("O Carrinho Esta vazio.");
        }

        $produtos = $carrinhoSession['carrinho']['produtos'];

        $total = 0;
        foreach ($produtos as $index => $produto) {
            $produtoResponse = Produto::with('produtoImagem.imagens')->find($produto['produto_id']);
            $produtoResponse['quantidade'] = $carrinhoSession['carrinho']['produtos'][$index]['quantidade'];
            $produtos[$index] = $produtoResponse;
            $total += $produtos[$index]['quantidade'] * $produtos[$index]['preco'];
        }

        $carrinhoResponse = $carrinhoSession;
        $carrinhoResponse['carrinho']['total'] = $total;
        $carrinhoResponse['carrinho']['produtos'] = array_values($produtos);

        return $carrinhoResponse;
    }

}
