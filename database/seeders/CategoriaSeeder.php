<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Categoria::insert([
            [
                'descricao' => 'Hortifruti',
                'prefix_categoria' => 'HOR',
            ],
            [
                'descricao' => 'Carnes e Aves',
                'prefix_categoria' => 'CAR',
            ],
            [
                'descricao' => 'Padaria',
                'prefix_categoria' => 'PAD',
            ],
            [
                'descricao' => 'Bebidas',
                'prefix_categoria' => 'BEB',
            ],
            [
                'descricao' => 'Limpeza',
                'prefix_categoria' => 'LIM',
            ],
            [
                'descricao' => 'Higiene Pessoal',
                'prefix_categoria' => 'HIG',
            ],
            [
                'descricao' => 'Laticínios',
                'prefix_categoria' => 'LAT',
            ],
            [
                'descricao' => 'Congelados',
                'prefix_categoria' => 'CON',
            ],
            [
                'descricao' => 'Mercearia',
                'prefix_categoria' => 'MER',
            ],
            [
                'descricao' => 'Outros',
                'prefix_categoria' => 'OUT',
            ],
        ]);
    }
}
