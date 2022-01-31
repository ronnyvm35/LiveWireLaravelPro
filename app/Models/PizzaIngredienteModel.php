<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class PizzaIngredienteModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'extra',
        'valor','pizza_id','ingrediente_id',
    ];
}
