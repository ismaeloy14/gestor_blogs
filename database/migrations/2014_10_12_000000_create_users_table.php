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
            $table->string('nombre_usuario')->unique();
            $table->string('password')->unique();
            $table->string('nombre');
            $table->string('apellidos');
            $table->string('email_usuario')->unique();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('pais_origen')->nullable();
            $table->binary('imagen_usuario')->nullable();
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
