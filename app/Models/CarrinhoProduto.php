<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CarrinhoProduto extends Model
{

    protected $fillable = [
        'id',
        'carrinho_id',
        'produto_id',
        'quantidade',
    ];

    protected $table = 'tr_carrinhos_produtos';

    public function carrinho(): BelongsTo
    {
        return $this->belongsTo(Carrinho::class, 'carrinho_id', 'id');
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }

}
