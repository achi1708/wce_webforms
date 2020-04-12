<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SqrfData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sqrf_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('requerimiento', 4);
            $table->string('nombre', 100);
            $table->string('direccion', 200)->nullable();
            $table->string('telefono', 30)->nullable();
            $table->string('email', 100);
            $table->string('rol', 100);
            $table->string('representacion', 100);
            $table->string('asunto', 254);
            $table->text('mensaje');
            $table->timestamp('fecha_reg')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sqrf_data');
    }
}
