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
        Schema::create('reporte', function (Blueprint $table) {
            $table->foreignId('usuario_reportador_id')->constrained('usuario');
            $table->foreignId('usuario_reportado_id')->constrained('usuario');
            $table->timestamp('fecha_y_hora');
            $table->primary(['usuario_reportador_id','usuario_reportado_id','fecha_y_hora']);
            $table->foreignId('admin_id')->constrained('usuario');
            $table->string('comentario');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reporte');
    }
};
