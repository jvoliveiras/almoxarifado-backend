<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')
            ->on('empresas')->onDelete('cascade');

            $table->unsignedBigInteger('fornecedor_id');
            $table->foreign('fornecedor_id')->references('id')
            ->on('fornecedores');

            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')
            ->on('users');

            $table->decimal('valor_bruto', 16,2);

            $table->decimal('desconto', 10,2)->default(0);
            $table->decimal('acrescimo', 10,2)->default(0);

            $table->string('qtd_itens')->nullable();

            $table->date('data_recebimento');

            $table->string('chave', 44)->nullable();
            $table->string('numero_nf', 20)->nullable();
            $table->string('tipo_insercao', 20);
            $table->string('observacao')->nullable();


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
        Schema::dropIfExists('compras');
    }
}
