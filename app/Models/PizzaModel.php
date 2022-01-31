<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzaModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'costo'
    ];

}
