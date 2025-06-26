<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PedidoHistorico extends Model
{

    protected $fillable = [
        'id',
        'pedido_id',
        'pedidos_status_id'
    ];

    protected $table = 'pedidos_historicos';

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(PedidoStatus::class, 'status_id', 'id');
    }
}
