<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agregar_aceptar', function (Blueprint $table) {
            $table->foreignId('usuario_agreagador_id')->constrained('users');
            $table->foreignId('usuario_agreagado_id')->constrained('users');
            $table->primary(['usuario_agreagador_id','usuario_agreagado_id']);
            $table->boolean('is_aceptado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agregar_aceptar');
    }
};
