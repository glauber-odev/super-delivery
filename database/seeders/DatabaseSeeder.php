<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'cpf' => '055.555.777.-09',
            'telefone_1' => '(61) 99999-0000',
            'telefone_2' => '(62) 77777-1111',
        ]);

        $this->call([
            CategoriaSeeder::class,
            EstadoSeeder::class,
            PedidoStatusSeeder::class,
            PeriodicidadeSeeder::class,
            TempoUnidadeSeeder::class,
        ]);
    }
}
