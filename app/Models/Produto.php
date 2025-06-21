<?php

namespace App\Models;

use App\Observers\ProdutoObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[ObservedBy([ProdutoObserver::class])]
class Produto extends Model
{

    protected $fillable = [
        'cod_barras',
        'nome',
        'preco',
        'saldo',
        'descricao',
        'categoria_id',
        'produto_imagem_id',
        'imagem'
    ];

    protected $table = 'produtos';

    public function produtoImagem(): BelongsTo
    {
        return $this->belongsTo(ProdutoImagem::class, 'produto_imagem_id', 'id');
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }

    public function avaliacoes(): HasMany
    {
        return $this->hasMany(ProdutoAvaliacao::class, 'id', 'produto_id');
    }

    public function produtoPedido(): BelongsTo
    {
        return $this->BelgonsTo(PedidoProduto::class, 'id', 'produto_id');
    }

    public function usersFavoritaram(): HasMany
    {
        return $this->hasMany(ProdutoUser::class, 'id', 'produto_id');
    }
}
