<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ID é baseado no IBGE
        Estado::insert([
            ['id' => 12, 'sigla' => 'AC', 'descricao' => 'Acre'],
            ['id' => 27, 'sigla' => 'AL', 'descricao' => 'Alagoas'],
            ['id' => 13, 'sigla' => 'AM', 'descricao' => 'Amazonas'],
            ['id' => 16, 'sigla' => 'AP', 'descricao' => 'Amapá'],
            ['id' => 29, 'sigla' => 'BA', 'descricao' => 'Bahia'],
            ['id' => 23, 'sigla' => 'CE', 'descricao' => 'Ceará'],
            ['id' => 53, 'sigla' => 'DF', 'descricao' => 'Distrito Federal'],
            ['id' => 32, 'sigla' => 'ES', 'descricao' => 'Espírito Santo'],
            ['id' => 52, 'sigla' => 'GO', 'descricao' => 'Goiás'],
            ['id' => 21, 'sigla' => 'MA', 'descricao' => 'Maranhão'],
            ['id' => 31, 'sigla' => 'MG', 'descricao' => 'Minas Gerais'],
            ['id' => 50, 'sigla' => 'MS', 'descricao' => 'Mato Grosso do Sul'],
            ['id' => 51, 'sigla' => 'MT', 'descricao' => 'Mato Grosso'],
            ['id' => 15, 'sigla' => 'PA', 'descricao' => 'Pará'],
            ['id' => 25, 'sigla' => 'PB', 'descricao' => 'Paraíba'],
            ['id' => 26, 'sigla' => 'PE', 'descricao' => 'Pernambuco'],
            ['id' => 22, 'sigla' => 'PI', 'descricao' => 'Piauí'],
            ['id' => 41, 'sigla' => 'PR', 'descricao' => 'Paraná'],
            ['id' => 33, 'sigla' => 'RJ', 'descricao' => 'Rio de Janeiro'],
            ['id' => 24, 'sigla' => 'RN', 'descricao' => 'Rio Grande do Norte'],
            ['id' => 43, 'sigla' => 'RS', 'descricao' => 'Rio Grande do Sul'],
            ['id' => 11, 'sigla' => 'RO', 'descricao' => 'Rondônia'],
            ['id' => 14, 'sigla' => 'RR', 'descricao' => 'Roraima'],
            ['id' => 42, 'sigla' => 'SC', 'descricao' => 'Santa Catarina'],
            ['id' => 28, 'sigla' => 'SE', 'descricao' => 'Sergipe'],
            ['id' => 35, 'sigla' => 'SP', 'descricao' => 'São Paulo'],
            ['id' => 17, 'sigla' => 'TO', 'descricao' => 'Tocantins'],
        ]);
    }
}
