<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{

    protected $fillable = [
        'descricao',
        'prefix_categoria',
    ];

    protected $table = 'categorias';

    public function produtos(): HasMany
    {
        return $this->hasMany(Produto::class, 'id', 'categoria_id');
    }
}
