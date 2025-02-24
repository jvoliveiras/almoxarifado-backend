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


}