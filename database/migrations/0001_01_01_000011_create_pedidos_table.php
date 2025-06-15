<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->boolean('flg_pago');
            $table->float('subtotal')->nullable(); //preço sem frete
            $table->float('total')->nullable();
            $table->boolean('flg_retirar_na_loja');
            $table->integer('horas_estimadas_separacao')->nullable(); //horas, interessante para retirada na loja
            $table->integer('dias_estimados_entrega')->nullable(); //dias
            $table->float('distancia')->nullable();
            $table->float('custo_frete')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('residencia_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('residencia_id')->references('id')->on('residencias');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
