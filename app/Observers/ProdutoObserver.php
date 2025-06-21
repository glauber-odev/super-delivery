<?php

namespace App\Observers;

use App\Models\Categoria;
use App\Models\Produto;

class ProdutoObserver
{
    /**
     * Atualiza o valor do código com a prefixo da Categoria e ID do produto
     */
    public function created(Produto $produto): void
    {
        // $prefixoCategoria = Categoria::where('id', $produto->categoria_id)->pluck('prefix_categoria');

        // $produto->cod_produto = $prefixoCategoria.$produto->id;
        // $produto->save();
    }

    /**
     * Handle the Produto "updated" event.
     */
    public function updated(Produto $produto): void
    {
        //
    }

    /**
     * Handle the Produto "deleted" event.
     */
    public function deleted(Produto $produto): void
    {
        //
    }

    /**
     * Handle the Produto "restored" event.
     */
    public function restored(Produto $produto): void
    {
        //
    }

    /**
     * Handle the Produto "force deleted" event.
     */
    public function forceDeleted(Produto $produto): void
    {
        //
    }
}
