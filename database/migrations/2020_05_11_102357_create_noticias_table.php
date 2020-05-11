<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->string('titulo_noticia');
            $table->text('cuerpo_noticia');
            $table->date('fecha_noticia');
            $table->binary('imagen_noticia')->nullable();
            $table->integer('id_blog')->unsigned();
            $table->foreign('id_blog')->references('id')->on('blogs');
            $table->boolean('noticia_publica');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('noticias');
    }
}
