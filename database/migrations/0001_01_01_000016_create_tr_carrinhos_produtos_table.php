<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tr_carrinhos_produtos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('carrinho_id');
            $table->bigInteger('produto_id');
            $table->integer('quantidade');

            $table->foreign('carrinho_id')->references('id')->on('carrinhos');
            $table->foreign('produto_id')->references('id')->on('produtos');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_carrinhos_produtos');
    }
};
