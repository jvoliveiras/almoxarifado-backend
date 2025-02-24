<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['empresa_id', 'categoria_id', 'nome', 'estoque_atual', 'estoque_total', 'unidade', 'controla_patrimonio', 'referencia', 'ativo', 'imagem', 'qtd_minima', 'qtd_excelente'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function patrimonios(){
        return $this->hasMany('App\Models\ProdutoPatrimonio', 'produto_id', 'id');
    }
}
