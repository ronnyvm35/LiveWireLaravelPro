<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\PizzaIngredienteModel;
use App\Models\PizzaModel;
use App\Models\IngredientesModel;

class AppLayout extends Component
{
    public $pizzasI;
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $this->pizzasI = PizzaIngredienteModel::select('pizza_ingrediente_models.id','pizza_models.nombre as pizza',
        'pizza_models.costo', 'pizza_models.descripcion', 'ingredientes_models.nombre as ingredientes', 'ingredientes_models.id as ingrediente_id', )
        ->join('pizza_models', 'pizza_ingrediente_models.pizza_id', '=', 'pizza_models.id')
        ->join('ingredientes_models', 'pizza_ingrediente_models.ingrediente_id', '=', 'ingredientes_models.id')
        ->orderBy('pizza_ingrediente_models.ingrediente_id', 'asc')
        ->get();
        return view('layouts.app');
    }
}
