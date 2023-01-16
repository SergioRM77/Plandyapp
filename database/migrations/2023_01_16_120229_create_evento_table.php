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
        Schema::create('evento', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('tipo_evento_id')->constrained('tipo_evento');
            $table->string('nombre_evento');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->string('tags')->nullable();
            $table->string('foto')->nullable();
            $table->timestamp('fecha_creacion');
            $table->dateTime('fecha_actualizado');
        });
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evento');
    }
};
