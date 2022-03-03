<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibroUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libro_usuario', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('libro_id')->unsigned()->nullable();
            $table->integer('usuario_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('libro_id')
                    ->references('id')
                    ->on('libros')->onDelete('cascade');
            $table->foreign('usuario_id')
                    ->references('id')
                    ->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libro_usuario');
    }
}
