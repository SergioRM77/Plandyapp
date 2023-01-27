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
        Schema::create('chat', function (Blueprint $table) {
            $table->foreignId('usuario_origen_id')->constrained('users');
            $table->foreignId('usuario_destino_id')->constrained('users');
            $table->timestamp('fecha_y_hora');
            $table->primary(['usuario_origen_id', 'usuario_destino_id', 'fecha_y_hora']);
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
        Schema::dropIfExists('chats');
    }
};
