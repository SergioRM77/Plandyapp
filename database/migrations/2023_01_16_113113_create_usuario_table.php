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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo');
            $table->string('email');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('localidad');
            $table->integer('codigo_postal');
            $table->string('intereses')->nullable();
            $table->string('contraseña');
            $table->string('foto')->nullable();
            $table->string('estado')->default('activo');
            $table->boolean('is_admin_sistema')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('usuario');
    }
};
