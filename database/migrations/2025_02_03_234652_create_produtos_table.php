<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')
            ->on('empresas')->onDelete('cascade');

            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')
            ->on('categorias');

            $table->string('nome');
  
            $table->decimal('estoque_total', 6, 2);
            $table->decimal('estoque_atual', 6, 2);

            $table->string('unidade');
            
            $table->string('referencia')->nullable();

            $table->string('imagem')->nullable();
            
            $table->boolean('controla_patrimonio')->default(1);

            $table->boolean('ativo')->default(1);

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
        Schema::dropIfExists('produtos');
    }
}
