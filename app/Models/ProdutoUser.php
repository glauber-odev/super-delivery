<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdutoUser extends Model
{

    protected $table = 'tr_produtos_users';

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }

    // Users que favoritaram
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
