<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PizzaIngredienteModel;
use App\Models\PizzaModel;
use App\Models\IngredientesModel;
use App\Models\PedidosModel;
use Illuminate\Support\Facades\DB;
use DateTime;
use Auth;

class ProductosList extends Component
{
    public $pizza, $extra, $valor ,$valorCal , $pizzasI,  $imagenEdit,  $pizza_id, $cantidad, $ingrediente_id, $estado, $pi_id, $costo, $imagen, $ingredientes;
    public $isModalOpen = false;

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
        $this->cantidad = '';
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
        $this->valor = $pizza->costo; 
        $this->imagenEdit = $pizza->imagen; 
        $this->pizza_id = $id; 
        $this->openModalPopover();
    }

    public function changeValor($value)
    {
        if ($value !=null) {
            $this->valorCal = $this->valor * $value;
        } 
    }
   
    public function store()
    { 
        $this->validate([
            'cantidad' => 'required', 
        ]);
         
            $pizza = PizzaModel::findOrFail($this->pizza_id);
             
            $idUser = auth()->id();
            
            $now = new DateTime();
            $total = $this->cantidad * $pizza->costo;

            $resp = PedidosModel::create([
                'user_id' => $idUser,
                'fecha' => $now->format('Y-m-d'),
                'hora' => $now->format('H:i:s'),
                'pizza_id' =>  $this->pizza_id,
                'cantidad' =>  $this->cantidad,
                'costo' => $total,
            ]);

            $this->isModalOpen = false;
            $this->cantidad = '';

            session()->flash('message', 'Pizza created.'.$resp); 
          
       
    }

}
