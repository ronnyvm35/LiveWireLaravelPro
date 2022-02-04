<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidosModel extends Model
{
    use HasFactory;

       protected $fillable = [
        'user_id',
        'fecha',
        'hora', 'pizza_id',
        'costo', 'cantidad'
    ];
}
