<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PizzaIngredienteModel;
use App\Models\PizzaModel;
use App\Models\IngredientesModel;
use Illuminate\Support\Facades\DB;

class PizzaIngredientes extends Component
{
    public $pizza, $extra, $valor , $pizzasI, $pizza_id, $ingrediente_id, $estado, $pi_id;
    public $isModalOpen = 0;

    public function render()
    {
        $this->pizzasI = PizzaIngredienteModel::select('pizza_ingrediente_models.id','pizza_models.nombre as pizza',
        'pizza_models.costo', 'pizza_models.descripcion', 'ingredientes_models.nombre as ingredientes', 'ingredientes_models.id as ingrediente_id', )
        ->join('pizza_models', 'pizza_ingrediente_models.pizza_id', '=', 'pizza_models.id')
        ->join('ingredientes_models', 'pizza_ingrediente_models.ingrediente_id', '=', 'ingredientes_models.id')
        ->orderBy('pizza_ingrediente_models.ingrediente_id', 'asc')
        ->get();
        $this->pizza = PizzaModel::all()->where('estado',true);
        $this->ingrediente = IngredientesModel::all()->where('estado',true);

        return view('livewire.pizza-ingredientes');
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

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'valor' => 'required',
            'pizza_id' => 'required',
            'extra' => 'required',
            'ingrediente_id' => 'required',
        ]);
        DB::beginTransaction();
        try {

            PizzaIngredienteModel::updateOrCreate(['id' => $this->pizza_id], [
                'extra' => $this->extra,
                'valor' => $this->valor,
                'pizza_id' => $this->pizza_id,
                'ingrediente_id' => $this->ingrediente_id,
            ]);

            PizzaModel::updateOrCreate(['id' => $this->pizza_id], [
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'estado' => true,
                'costo' => $this->costo,
            ]);

            session()->flash('message', $this->pizza_id ? 'Pizza updated.' : 'Pizza created.');

            $this->closeModalPopover();
            $this->resetCreateForm();

        } catch (\Exception $e) {
            session()->flash('message', $e);
            DB::rollback();
            // something went wrong
        }
    }

    public function edit($id)
    {
        //$pizza = PizzaIngredienteModel::findOrFail($id);
        $pizza = PizzaIngredienteModel::select('pizza_ingrediente_models.id','pizza_models.nombre as pizza',
        'pizza_ingrediente_models.extra',
        'pizza_models.costo', 'pizza_models.descripcion', 'ingredientes_models.nombre as ingredientes',
        'ingredientes_models.id as ingrediente_id', )
        ->join('pizza_models', 'pizza_ingrediente_models.pizza_id', '=', 'pizza_models.id')
        ->join('ingredientes_models', 'pizza_ingrediente_models.ingrediente_id', '=', 'ingredientes_models.id')
        ->orderBy('pizza_ingrediente_models.ingrediente_id', 'asc')
        ->findOrFail($id);
        $this->id = $id;
        $this->pizza_id = $pizza->pizza_id;
        $this->nombre = $pizza->pizza;
        $this->descripcion = $pizza->descripcion;
        $this->valor = $pizza->valor;
        $this->costo = $pizza->costo;
        $this->extra = $pizza->extra;

        $this->openModalPopover();
    }

    public function delete($id)
    {
        PizzaIngredienteModel::find($id)->delete();
        session()->flash('message', 'Pizza deleted.');
    }
}
