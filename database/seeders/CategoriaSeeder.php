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
                'descricao' => 'Mercearia',
                'prefix_categoria' => 'MER',
            ],
            [
                'descricao' => 'Bebidas',
                'prefix_categoria' => 'BEB',
            ],
            [
                'descricao' => 'Carnes',
                'prefix_categoria' => 'CAR',
            ],
            [
                'descricao' => 'Limpeza',
                'prefix_categoria' => 'LIM',
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
                'descricao' => 'Hortifruti',
                'prefix_categoria' => 'HOR',
            ],
            [
                'descricao' => 'Bomboniere',
                'prefix_categoria' => 'BOM',
            ],
            [
                'descricao' => 'Outros',
                'prefix_categoria' => 'OUT',
            ],
        ]);
    }
}
