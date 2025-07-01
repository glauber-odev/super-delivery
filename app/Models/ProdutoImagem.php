<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProdutoImagem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'posicao_lista',
        'imagem_id',
    ];

    protected $table = 'produtos_imagens';

    public function imagens(): BelongsTo
    {
        return $this->belongsTo(Imagem::class, 'imagem_id', 'id');
    }

    public function produto(): HasOne
    {
        return $this->HasOne(Produto::class, 'id', 'produto_imagem_id');
    }
}
