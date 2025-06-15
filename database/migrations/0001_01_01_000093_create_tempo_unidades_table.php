<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tempo_unidades', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('unidade'); // pode receber dias do Mês ou da Semana
            $table->integer('posicao_ordem'); // Posição na fila
            $table->integer('periodicidade_id');

            $table->foreign('periodicidade_id')->references('id')->on('periodicidades');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempo_unidades');
    }
};
