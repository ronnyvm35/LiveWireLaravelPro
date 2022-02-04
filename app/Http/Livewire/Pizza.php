<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PizzaModel;
use Illuminate\Support\Facades\DB; 
use Livewire\WithFileUploads; 
use Illuminate\Support\Facades\Storage;

class Pizza extends Component
{
    public $pizza, $nombre, $descripcion, $costo, $imagen, $imagenEdit,
        $estado, $pizza_id;
    public $isModalOpen = 0;
    use WithFileUploads;

    public function render()
    {
        $this->pizzas = PizzaModel::all();
        return view('livewire.pizza');
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
        $this->descripcion = '';   $this->imagen = '';  $this->imagenEdit = ''; 
        $this->estado = false;
        $this->costo = '';
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'estado' => 'required',  
            'costo' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $name = $this->imagenEdit;
            if($this->imagen != null || $this->imagen != ''){
            
                $name = md5($this->imagen . microtime()).'.'.$this->imagen->extension();
                $this->imagen->storeAs('img', $name);
            }

            PizzaModel::updateOrCreate(['id' => $this->pizza_id], [
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'estado' => $this->estado,
                'imagen' =>  $name,
                'costo' => $this->costo,
            ]);
 
            session()->flash('message', $this->pizza_id ? 'Pizza updated.' : 'Pizza created.');

            $this->closeModalPopover();
            $this->resetCreateForm();
            DB::commit();

        } catch (\Exception $e) {
            session()->flash('message', $e);
            DB::rollback();
        }
    }

    public function edit($id)
    {
        $pizza = PizzaModel::findOrFail($id);
        $this->pizza_id = $id;
        $this->nombre = $pizza->nombre;
        $this->descripcion = $pizza->descripcion;
        $this->estado = $pizza->estado;
        //$this->imagen = $pizza->imagen;
        $this->imagenEdit = $pizza->imagen;
        $this->costo = $pizza->costo;

        $this->openModalPopover();
    }

    public function delete($id)
    {
        PizzaModel::find($id)->delete();
        session()->flash('message', 'Pizza deleted.');
    }
}
