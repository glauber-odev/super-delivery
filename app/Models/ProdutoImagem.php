<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProdutoImagem extends Model
{

    protected $table = 'produtos_imagens';

    public function imagens(): HasMany
    {
        return $this->hasMany(Imagem::class, 'imagem_id', 'id');
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'id', 'produto_imagem_id');
    }
}
