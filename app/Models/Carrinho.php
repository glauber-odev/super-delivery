<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Carrinho extends Model
{

    protected $fillable = [
        'titulo',
        'total',
        'flg_favorito',
        'user_id',
        'residencia_id',
    ];

    protected $table = 'carrinhos';

    public function produtos(): HasMany
    {
        return $this->hasMany(Produto::class, 'id', 'produto_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function usersFavoritaram(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function carrinhoProdutos(): HasMany
    {
        return $this->hasMany(CarrinhoProduto::class, 'carrinho_id', 'id');
    }

    public function residencia(): BelongsTo
    {
        return $this->belongsTo(Residencia::class, 'residencia_id', 'id');
    }

    public function pedidoProgramado(): BelongsTo
    {
        return $this->belongsTo(PedidoProgramado::class, 'id', 'carrinho_id');
    }
}
