<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');                      
            $table->string('nome');
            $table->string('empresa');
            $table->string('email')->unique();
            $table->string('telefone')->nullable();   
            $table->string('cpf')->nullable();          
            $table->string('cnpj')->nullable();          
            $table->string('senha');
            $table->string('reset_token');
            $table->string('confirmation_token')->nullable();
            $table->string('imagem')->nullable();
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
        Schema::dropIfExists('usuarios');
    }
}
