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
        Schema::create('chat_evento', function (Blueprint $table) {
            $table->foreignId('evento_id')->constrained('evento');
            $table->foreignId('usuario_id')->constrained('usuario');
            $table->timestamp('fecha_y_hora');
            $table->primary(['evento_id', 'usuario_id', 'fecha_y_hora']);
            $table->string('contenido');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_evento');
    }
};
