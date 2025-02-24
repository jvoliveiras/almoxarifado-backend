<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $fillable = ['empresa_id', 'nome', 'cpf', 'celular', 'token_liberacao'];

    public function itens(){
        return $this->hasMany('App\Models\ProdutoFuncionario', 'funcionario_id', 'id');
    }

    public function itensAlocados()
    {
        return $this->hasMany('App\Models\ProdutoFuncionario', 'funcionario_id', 'id')
                    ->where('devolvido', false);
    }
}
