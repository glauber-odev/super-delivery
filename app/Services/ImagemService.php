<?php

namespace App\Services;

use App\Models\Imagem;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImagemService
{

    public function create(UploadedFile $request)
    {
        return DB::transaction(function () use ($request) {

            $nome_original = $request->getClientOriginalName();
            $extensao      = $request->getClientOriginalExtension();
            $uploadName    = md5(uniqid(rand(), true)) . '.' . $extensao;

            Storage::disk('public')->putFileAs("images/produtos", $request, $uploadName);

            $imagem = Imagem::create([
                'nome_original' => $nome_original,
                'caminho_arquivo' => $uploadName,
            ]);

            return $imagem;
        });
    }

    public function fetch($request)
    {
        return DB::transaction(function () use ($request) {

            $imagems = Imagem::all();

            if ($imagems == null) throw new FileNotFoundException('Nenhum Imagem foi encontrado.');

            return $imagems;
        });
    }

    public function findById($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $imagem = Imagem::find($id);

            if ($imagem == null) throw new FileNotFoundException('o Imagem não foi encontrado.');

            return $imagem;
        });
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $imagem = Imagem::find($id);

            // verifica se já possui imagem
            if(!empty($imagem)) {
                $path = "imagens/produtos/".$imagem->caminho_arquivo;

                if(Storage::exists($path)) {
                    Storage::disk('public')->delete($path);
                }

            } else {
                $imagem = new Imagem();
            }

            $nome_original = $request->getClientOriginalName();
            $extensao      = $request->getClientOriginalExtension();
            $uploadName    = md5(uniqid(rand(), true)) . '.' . $extensao;

            Storage::disk('public')->putFileAs("images/produtos", $request, $uploadName);

            $imagem->nome_original = $nome_original;
            $imagem->caminho_arquivo = $uploadName;
            $imagem->save();

            return $imagem;
        });
    }

    public function delete($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $imagem = Imagem::findOrFail($id);
            $imagem->delete();

            return $imagem;
        });
    }
}
