<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoFuncionarioDevsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_funcionario_devs', function (Blueprint $table) {
            $table->id();

            $table->string('codigo_emprestimo');

            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')
            ->on('produto_funcionarios');

            $table->decimal('quantidade_devolvida', 6, 3);

            $table->date('data_devolucao');

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
        Schema::dropIfExists('produto_funcionario_devs');
    }
}
