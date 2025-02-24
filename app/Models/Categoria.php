<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'empresa_id'
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function produtos(){
        return $this->hasMany('App\Models\Produto', 'categoria_id', 'id');
    }
}
