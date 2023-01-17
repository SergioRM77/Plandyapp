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
        Schema::create('gasto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evento_id')->constrained('evento');
            $table->foreignId('usuario_id')->constrained('usuario');
            $table->string('descripcion');
            $table->float('coste', 6, 2);
            $table->timestamp('fecha_hora');
            $table->dateTime('fecha_hora_actualizado');
            $table->string('foto')->nullable();
            $table->boolean('is_aceptado')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gasto');
    }
};
