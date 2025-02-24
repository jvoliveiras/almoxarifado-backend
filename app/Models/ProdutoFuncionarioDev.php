<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoFuncionarioDev extends Model
{
    use HasFactory;

    protected $fillable = ['codigo_emprestimo', 'item_id', 'quantidade_devolvida', 'data_devolucao'];
}
