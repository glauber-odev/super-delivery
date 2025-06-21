<?php

namespace App\Services;

use App\Models\Produto;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\DB;


class ProdutoService
{

    protected $imagemService;
    protected $produtoImagemService;

    public function __construct(ImagemService $imagemService, ProdutoImagemService $produtoImagemService)
    {
        $this->imagemService = $imagemService;
        $this->produtoImagemService = $produtoImagemService;
    }

    public function create($request)
    {
        return DB::transaction(function () use ($request) {

            $produtoRequest = $request->except(['imagem']);

            $produto = new Produto($produtoRequest);

            // adiciona a imagem caso haja
            if ($request->hasFile('imagem')) {

                $imagemRequest = $request->file('imagem');
                $imagem = $this->imagemService->create($imagemRequest);

                $produtoImagem = $this->produtoImagemService->create([
                    'posicao_lista' => 1,
                    'imagem_id' => $imagem->id
                ]);

                $produto->produto_imagem_id = $produtoImagem->id;
            }

            $produto->save();

            return $produto;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $produtos = Produto::with(['categoria','produtoImagem.imagens'])->get();

            if ($produtos == null) throw new FileNotFoundException('Nenhum Produto foi encontrado.');

            return $produtos;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $produto = Produto::find($id);

            if ($produto == null) throw new FileNotFoundException('o Produto não foi encontrado.');

            return $produto;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $produtoRequest = $request->except(['imagem','imagem_id']);
            $imagem_id = $request->input('imagem_id');

            $produto = Produto::findOrFail($id);
            $produto->fill($produtoRequest);

            // adiciona a imagem caso haja
            if ($request->hasFile('imagem')) {

                $imagemRequest = $request->file('imagem');
                $imagem = $this->imagemService->update($imagemRequest, $imagem_id);

                if(!empty($request->imagem_id)) {
                    $produtoImagem = $this->produtoImagemService->create([
                    'posicao_lista' => 1,
                    'imagem_id' => $imagem->id
                    ]);
                }

                $produto->produto_imagem_id = $produtoImagem->id;

            }

            $produto->save();

            return $produto;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $produto = Produto::findOrFail($id);
            $produto->delete();

            return $produto;
        });
    }
}
