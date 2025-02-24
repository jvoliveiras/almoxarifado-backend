<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_compras', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('compra_id');
            $table->foreign('compra_id')->references('id')
            ->on('compras')->onDelete('cascade');

            $table->unsignedBigInteger('produto_id');
            $table->foreign('produto_id')->references('id')
            ->on('produtos');

            $table->decimal('quantidade', 16,2);
            $table->decimal('valor_unitario', 16,2);
            $table->decimal('subtotal', 16,2);

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
        Schema::dropIfExists('item_compras');
    }
}
