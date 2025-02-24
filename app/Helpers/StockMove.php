<?php

namespace App\Helpers;

use App\Models\Produto;

class StockMove {

    public function diminuiEstoque($produto_id, $quantidade){
        $produto = Produto::find($produto_id);

        $produto->estoque_atual -= $quantidade;
        $produto->save();
    }

    public function aumentaEstoque($produto_id, $quantidade){
        $produto = Produto::find($produto_id);

        $produto->estoque_atual += $quantidade;
        $produto->save();
    }

    public function aumentaEstoqueTotal($produto_id, $quantidade){
        $produto = Produto::find($produto_id);

        $produto->estoque_atual += $quantidade;
        $produto->estoque_total += $quantidade;
        $produto->save();
    }

    public function diminuiEstoqueTotal($produto_id, $quantidade){
        $produto = Produto::find($produto_id);

        $produto->estoque_atual -= $quantidade;
        $produto->estoque_total -= $quantidade;
        $produto->save();
    }
}