<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TempoUnidade extends Model
{
    protected $fillable = [
        'id',
        'unidade',
        'posicao_ordem',
        'periodicidade_id',
    ];
    
    protected $table = 'tempo_unidades';

    public function pedidosProgramados(): HasMany
    {
        return $this->hasMany(PedidoProgramado::class, 'id', 'tempo_unidade_id');
    }

    public function periodicidade(): BelongsTo
    {
        return $this->belongsTo(Periodicidade::class, 'periodicidade_id', 'id');
    }
}
