<?php

namespace Database\Seeders;

use App\Models\PedidoStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PedidoStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PedidoStatus::insert([
            [
                'id' => 1,
                'descricao' => 'Pendente',
                'sigla' => 'PEN',
            ],
            [
                'id' => 2,
                'descricao' => 'Confirmado',
                'sigla' => 'CON',
            ],
            [
                'id' => 3,
                'descricao' => 'Em Separação',
                'sigla' => 'SEP',
            ],
            [
                'id' => 4,
                'descricao' => 'Enviado',
                'sigla' => 'ENV',
            ],
            [
                'id' => 5,
                'descricao' => 'Entregue',
                'sigla' => 'ENT',
            ],
            [
                'id' => 6,
                'descricao' => 'Cancelado',
                'sigla' => 'CAN',
            ]
        ]);
    }
}
