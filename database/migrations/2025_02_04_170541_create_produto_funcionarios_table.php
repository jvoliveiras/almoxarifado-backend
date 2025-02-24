<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_funcionarios', function (Blueprint $table) {
            $table->id();

            $table->string('codigo_emprestimo');

            $table->unsignedBigInteger('funcionario_id');
            $table->foreign('funcionario_id')->references('id')
            ->on('funcionarios');

            $table->unsignedBigInteger('produto_id');
            $table->foreign('produto_id')->references('id')
            ->on('produtos');

            $table->string('patrimonio_produto')->nullable();

            $table->decimal('quantidade', 6, 3);
            $table->decimal('quantidade_devolvida', 6, 3)->default(0);

            $table->boolean('devolvido')->default(0);
            $table->date('data_ultima_devolucao')->nullable();

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
        Schema::dropIfExists('produtos_funcionarios');
    }
}
