<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Periodicidade extends Model
{

    protected $fillable = [
        'id',
        'descricao',
    ];

    const SEMANAL = 1;
    const MENSAL = 2;

    protected $table = 'periodicidades';

    public function PedidoProgramado(): HasMany
    {
        return $this->hasMany(PedidoProgramado::class, 'id', 'periodicidade_id');
    }

    public function tempoUnidades(): HasMany
    {
        return $this->hasMany(TempoUnidade::class, 'id', 'periodicidade_id');
    }
}
