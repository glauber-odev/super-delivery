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
        Schema::create('carrinhos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo')->nullable();
            $table->float('total')->nullable();
            $table->boolean('flg_favorito')->nullable();
            $table->bigInteger('user_id');
            $table->bigInteger('residencia_id');
            $table->timestamps();

            $table->foreign('residencia_id')->references('id')->on('residencias');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrinhos');
    }
};
