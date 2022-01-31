<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\IngredientesModel;

class Ingredientes extends Component
{
    public $ingrediente, $nombre,
    $estado, $ingrediente_id;
    public $isModalOpen = 0;

    public function render()
    {
        $this->ingredientes = IngredientesModel::all()->where('estado', true);
        return view('livewire.ingredientes');
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

    private function resetCreateForm(){
        $this->nombre = '';
        $this->estado = false;
    }

    public function store()
    {
        $this->validate([
            'nombre' => 'required',
            'estado' => 'required',
        ]);

        IngredientesModel::updateOrCreate(['id' => $this->ingrediente_id], [
            'nombre' => $this->nombre,
            'estado' => $this->estado,
        ]);

        session()->flash('message', $this->ingrediente_id ? 'Ingrediente updated.' : 'Ingrediente created.');

        $this->closeModalPopover();
        $this->resetCreateForm();
    }

    public function edit($id)
    {
        $data = IngredientesModel::findOrFail($id);
        $this->ingrediente_id = $id;
        $this->nombre = $data->nombre;
        $this->estado = $data->estado;

        $this->openModalPopover();
    }

    public function delete($id)
    {
        IngredientesModel::find($id)->delete();
        session()->flash('message', 'Ingrediente deleted.');
    }
}
