<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function carrinhos(): HasMany
    {
        return $this->hasMany(Carrinho::class, 'id', 'user_id');
    }

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class, 'id', 'user_id');
    }

    public function pedidoProgramado(): HasOne
    {
        return $this->hasOne(PedidoProgramado::class, 'id', 'user_id');
    }

    public function residencias(): HasMany
    {
        return $this->hasMany(Residencia::class, 'id', 'user_id');
    }

    public function produtosFavoritos(): HasMany
    {
        return $this->hasMany(ProdutoUser::class, 'id', 'user_id')
                ->where('flg_favorito', true);
    }

    public function avaliacoes(): HasMany
    {
        return $this->hasMany(ProdutoAvaliacao::class, 'id', 'user_id');
    }

}
