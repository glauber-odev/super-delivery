<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Residencia extends Model
{

    protected $table = 'residencias';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function estado(): BelongsTo
    {
        return $this->belongsTo(Estado::class, 'estado_id', 'id');
    }

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class, 'estado_id', 'id');
    }
}
