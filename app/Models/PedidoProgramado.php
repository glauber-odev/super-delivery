<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PedidoProgramado extends Model
{

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
}
