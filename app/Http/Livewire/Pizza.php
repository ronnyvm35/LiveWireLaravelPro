<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PizzaModel;
use Illuminate\Support\Facades\DB;

class Pizza extends Component
{
    public $pizza, $nombre, $descripcion, $costo,
        $estado, $pizza_id;
    public $isModalOpen = 0;

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
        $this->descripcion = '';
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

            PizzaModel::updateOrCreate(['id' => $this->pizza_id], [
                'nombre' => $this->nombre,
                'descripcion' => $this->descripcion,
                'estado' => $this->estado,
                'costo' => $this->costo,
            ]);

            session()->flash('message', $this->pizza_id ? 'Pizza updated.' : 'Pizza created.');

            $this->closeModalPopover();
            $this->resetCreateForm();
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
        $this->costo = $pizza->costo;

        $this->openModalPopover();
    }

    public function delete($id)
    {
        PizzaModel::find($id)->delete();
        session()->flash('message', 'Pizza deleted.');
    }
}
