<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pedido extends Model
{

    protected $fillable = [
        'flg_pago',
        'subtotal',
        'total',
        'flg_retirar_na_loja',
        'dias_estimados_entrega',
        'custo_frete',
        'user_id',
        'residencia_id',
    ];

    protected $table = 'pedidos';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function historico(): HasMany
    {
        return $this->hasMany(PedidoHistorico::class, 'id', 'pedido_id');
    }

    public function pedidoProdutos(): HasMany
    {
        return $this->hasMany(PedidoProduto::class, 'pedido_id', 'id');
    }

    public function residencia(): HasOne
    {
        return $this->hasOne(Residencia::class, 'id', 'residencia_id');
    }

    public function pedidoProgramado(): HasOne
    {
        return $this->hasOne(PedidoProgramado::class, 'id', 'pedido_id');
    }
}
