<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pedidos_programados', function (Blueprint $table) {
            $table->id();
            $table->boolean('flg_habilitado');
            $table->boolean('flg_debito_automatico');
            $table->bigInteger('periodicidade_id');
            $table->bigInteger('tempo_unidade_id');
            $table->timestamps();

            $table->foreign('periodicidade_id')->references('id')->on('periodicidades');
            $table->foreign('tempo_unidade_id')->references('id')->on('tempo_unidades');
        });

        //pagamentos

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos_programados');
    }
};
