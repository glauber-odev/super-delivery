<?php

namespace Database\Seeders;

use App\Models\TempoUnidade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TempoUnidadeSeeder extends Seeder
{
    // Dias da Semana por extenso (periodicidade_id = 1)
    const DIAS_SEMANA = [
        'Domingo',
        'Segunda-feira',
        'Terça-feira',
        'Quarta-feira',
        'Quinta-feira',
        'Sexta-feira',
        'Sábado',
    ];

    // Dias do Mês por extenso (periodicidade_id = 2)
    const DIAS_MES = [
        'Primeiro',
        'Segundo',
        'Terceiro',
        'Quarto',
        'Quinto',
        'Sexto',
        'Sétimo',
        'Oitavo',
        'Nono',
        'Décimo',
        'Décimo Primeiro',
        'Décimo Segundo',
        'Décimo Terceiro',
        'Décimo Quarto',
        'Décimo Quinto',
        'Décimo Sexto',
        'Décimo Sétimo',
        'Décimo Oitavo',
        'Décimo Nono',
        'Vigésimo',
        'Vigésimo Primeiro',
        'Vigésimo Segundo',
        'Vigésimo Terceiro',
        'Vigésimo Quarto',
        'Vigésimo Quinto',
        'Vigésimo Sexto',
        'Vigésimo Sétimo',
        'Vigésimo Oitavo',
        'Vigésimo Nono',
        'Trigésimo',
        'Trigésimo Primeiro',
    ];

    const MESES = [
        'Janeiro',
        'Fevereiro',
        'Março',
        'Abril',
        'Maio',
        'Junho',
        'Julho',
        'Agosto',
        'Setembro',
        'Outubro',
        'Novembro',
        'Dezembro',
    ];


    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $tempoUnidades = [];
        foreach ($this::DIAS_SEMANA as $index => $diaExtenso) {
            $tempoUnidades[] = [
                'unidade' => $diaExtenso,
                'posicao_ordem' => $index + 1,
                'periodicidade_id' => 1,
            ];
        }

        TempoUnidade::insert($tempoUnidades);

        $tempoUnidades = [];
        foreach ($this::DIAS_MES as $index => $diasMes) {
            $tempoUnidades[] = [
                'unidade' => $diasMes,
                'posicao_ordem' => $index + 1,
                'periodicidade_id' => 2,
            ];
        }

        TempoUnidade::insert($tempoUnidades);
    }
}
