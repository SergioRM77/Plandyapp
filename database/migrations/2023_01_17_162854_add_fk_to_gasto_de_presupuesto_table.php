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
        Schema::table('gastos_de_presupuesto', function (Blueprint $table) {
            $table->foreignId('evento_id')->after('id')->constrained('eventos');
            $table->foreignId('admin_id')->after('id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gastos_de_presupuesto', function (Blueprint $table) {
            // $table->dropColumn('evento_id');
            // $table->dropColumn('admin_id');

            $table->dropConstrainedForeignId('evento_id');
            $table->dropConstrainedForeignId('admin_id');
        });
    }
};
