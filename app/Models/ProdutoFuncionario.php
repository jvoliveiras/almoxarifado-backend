<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoFuncionario extends Model
{
    use HasFactory;

    protected $fillable = ['codigo_emprestimo', 'produto_id', 'funcionario_id', 'quantidade', 'quantidade_devolvida', 'devolvido', 'data_ultima_devolucao', 'patrimonio_produto'];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function devolucoes()
    {
        return $this->hasMany('App\Models\ProdutoFuncionarioDev', 'item_id', 'id');
    }
}
