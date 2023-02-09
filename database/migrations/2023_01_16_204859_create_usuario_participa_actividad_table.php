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
        Schema::create('usuario_participa_actividad', function (Blueprint $table) {
            $table->foreignId('actividad_id')->constrained('actividades');
            $table->foreignId('participante_id')->constrained('users');
            $table->primary(['actividad_id','participante_id']);
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
        Schema::dropIfExists('usuario_participa_actividad');
    }
};
