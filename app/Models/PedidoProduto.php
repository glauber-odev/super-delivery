<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PedidoProduto extends Model
{
    protected $fillable = [
        'id',
        'pedido_id',
        'produto_id',
        'quantidade',
    ];

    protected $table = 'tr_pedidos_produtos';

    public function pedidos(): BelongsTo
    {
        return $this->belongsTo(PedidoStatus::class, 'pedido_id', 'id');
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }

}
