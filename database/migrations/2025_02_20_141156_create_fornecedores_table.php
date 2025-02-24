<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedores', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')
            ->on('empresas')->onDelete('cascade');

            $table->string('nome_fantasia', 80);
            $table->string('razao_social', 100)->nullable();
            $table->string('cpf_cnpj', 19);
            // $table->string('ie_rg', 20);
            // $table->string('rua', 80);
            // $table->string('numero', 10);
            // $table->string('bairro', 50);
            // $table->string('telefone', 20);
            // $table->string('celular', 20)->default("00 00000 0000");
            // $table->string('email', 40)->default(null);
            // $table->string('cep', 10)->default(null);

            // $table->integer('cidade_id')->unsigned();
            // $table->foreign('cidade_id')->references('id')->on('cidades')->onDelete('cascade');
            // $table->integer('contribuinte');
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
        Schema::dropIfExists('fornecedores');
    }
}
