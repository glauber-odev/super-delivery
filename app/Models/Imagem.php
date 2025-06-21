<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Imagem extends Model
{

    protected $fillable = [
        'nome_original',
        'caminho_arquivo',
    ];

    protected $table = 'imagens';

    public function produtoImagem(): HasMany
    {
        return $this->hasMany(ProdutoImagem::class, 'id', 'imagem_id');
    }
}
