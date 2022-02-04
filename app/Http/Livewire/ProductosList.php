<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PizzaIngredienteModel;
use App\Models\PizzaModel;
use App\Models\IngredientesModel;

class ProductosList extends Component
{
    public $pizza, $extra, $valor , $pizzasI,  $imagenEdit,  $pizza_id, $ingrediente_id, $estado, $pi_id, $costo, $imagen, $ingredientes;
    public $isModalOpen = 0;

    public function render()
    {
        $this->pizzasI = PizzaModel::select('pizza_models.id',
        'pizza_models.nombre as pizza','pizza_models.imagen',
        'pizza_models.costo', 'pizza_models.descripcion',
        ) 
        ->orderBy('pizza_models.id', 'asc')
        ->get();

        return view('livewire.productos-list');
    }
    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }

    private function resetCreateForm()
    {
        $this->nombre = '';
        $this->descripcion = '';
        $this->valor = '';
        $this->pizza_id = '';
        $this->extra = false;
        $this->ingrediente_id = '';
    }

    public function edit($id)
    {
        //$pizza = PizzaIngredienteModel::findOrFail($id);
        $pizza = PizzaModel::select('pizza_models.id',
        'pizza_models.nombre as pizza','pizza_models.imagen',
        'pizza_models.costo', 'pizza_models.descripcion',
        )->findOrFail($id);

        $this->id = $id; 
        $this->nombre = $pizza->pizza;
        $this->descripcion = $pizza->descripcion;
        $this->valor = $pizza->valor; 
        $this->imagenEdit = null;
        $this->openModalPopover();
    }

}
