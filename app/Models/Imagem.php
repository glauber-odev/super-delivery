<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Imagem extends Model
{

    protected $table = 'imagens';

    public function produtoImagem(): BelongsTo
    {
        return $this->belongsTo(ProdutoImagem::class, 'id', 'imagem_id');
    }
}
