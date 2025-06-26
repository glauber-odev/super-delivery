<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PedidoStatus extends Model
{

    protected $fillable = [
        'id',
        'descricao',
        'sigla',
    ];

    protected $table = 'pedidos_status';

    public function historico(): HasMany
    {
        return $this->hasMany(PedidoHistorico::class, 'id', 'pedido_status_id');
    }

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class, 'id', 'pedido_status_id');
    }
}
