<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCompra extends Model
{
    use HasFactory;

    protected $fillable = [
        'compra_id', 'produto_id', 'quantidade', 'valor_unitario', 'subtotal'
    ];
}
