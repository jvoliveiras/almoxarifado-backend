<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();

            $table->string('nome');
            $table->string('cnpj', 19)->nullable();
            $table->string('logradouro', 80)->nullable();
            $table->string('numero', 10)->nullable();
            $table->string('complemento', 100)->default('')->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('cidade', 50)->nullable();
            $table->string('UF', 2)->nullable();
            $table->string('fone', 20)->nullable();
            $table->string('cep', 10)->nullable();
            $table->string('email', 60)->nullable();
            $table->string('logo', 100)->default('');
            
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
        Schema::dropIfExists('empresas');
    }
}
