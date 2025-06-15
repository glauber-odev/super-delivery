<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tr_pedidos_produtos', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->bigIncrements('pedido_id');
            $table->bigIncrements('produto_id');
            $table->integer('quantidade');

            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_pedidos_produtos');
    }
};
