<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Estado extends Model
{

    protected $fillable = [
        'id',
        'sigla',
        'descricao'
    ];
    
    protected $table = 'estados';

    public function residencias(): HasMany
    {
        return $this->hasMany(Residencia::class, 'id', 'estado_id');
    }
}
