<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PedidoProgramado extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'flg_habilitado',
        'flg_debito_automatico',
        'periodicidade_id',
        'tempo_unidade_id',
        'carrinho_id',
    ];

    protected $table = 'pedidos_programados';

    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class, 'pedido_id', 'id');
    }

    public function periodicidade(): BelongsTo
    {
        return $this->belongsTo(Periodicidade::class, 'periodicidade_id', 'id');
    }

    public function tempoUnidade(): BelongsTo
    {
        return $this->belongsTo(TempoUnidade::class, 'tempo_unidade_id', 'id');
    }

    public function carrinho(): HasOne
    {
        return $this->hasOne(Carrinho::class, 'id', 'carrinho_id');
    }
}
