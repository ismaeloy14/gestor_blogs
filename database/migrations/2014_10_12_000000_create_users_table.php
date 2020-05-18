<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('usuario')->unique();
            $table->string('password')->unique();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('email')->unique();
            $table->date('fechaNacimiento')->nullable();
            $table->string('pais')->nullable();
            $table->binary('imagenPerfil')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('paginaWeb')->nullable();
            $table->string('rol');
            $table->foreign('rol')->references('rol')->on('roles');
            //$table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
