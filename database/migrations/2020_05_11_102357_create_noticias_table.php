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
            $table->string('tituloNoticia');
            $table->text('cuerpoNoticia');
            $table->date('fechaNoticia');
            $table->string('imagenNoticia')->nullable();
            $table->unsignedBigInteger('idBlog');
            $table->foreign('idBlog')->references('id')->on('blogs');
            $table->boolean('noticiaPublica');
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
