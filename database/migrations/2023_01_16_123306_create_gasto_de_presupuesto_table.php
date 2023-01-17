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
        Schema::create('gasto_de_presupuesto', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion_gasto_pre');
            $table->float('coste', 6 ,2);
            $table->date('fecha');
            $table->string('foto')->nullable();
            $table->timestamp('fecha_creacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gasto_de_presupuesto');
    }
};
