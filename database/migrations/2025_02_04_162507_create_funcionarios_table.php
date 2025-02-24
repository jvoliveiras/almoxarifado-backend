<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')
            ->on('empresas')->onDelete('cascade');

            $table->string('nome', 100);
            $table->string('cpf', 20)->nullable();
            $table->string('celular', 20)->nullable();
            $table->string('token_liberacao', 100)->nullable();

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
        Schema::dropIfExists('funcionarios');
    }
}
