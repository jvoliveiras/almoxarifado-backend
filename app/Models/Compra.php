<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'empresa_id', 'fornecedor_id', 'usuario_id', 'valor_bruto', 'desconto', 'acrescimo', 'qtd_itens', 'chave', 'numero_nf',
        'tipo_insercao', 'observacao', 'data_recebimento'
    ];

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
}
