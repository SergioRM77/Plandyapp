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
        Schema::create('bloquear_desbloquear', function (Blueprint $table) {
            $table->foreignId('usuario_bloqueador_id')->constrained('users');
            $table->foreignId('usuario_bloqueado_id')->constrained('users');
            $table->primary(['usuario_bloqueador_id','usuario_bloqueado_id']);
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
        Schema::dropIfExists('bloquear_desbloquear');
    }
};
