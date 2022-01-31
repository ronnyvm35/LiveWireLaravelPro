<x-slot name="header">
    <h2 class="text-center">Ingredientes</h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            @if (session()->has('message'))
            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3"
                role="alert">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ session('message') }}</p>
                    </div>
                </div>
            </div>
            @endif
            <button wire:click="create()"
                class="my-4 inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base font-bold text-white shadow-sm hover:bg-red-700">
                Create Ingredientes
            </button>
            @if($isModalOpen)
            @include('livewire.ingredientes.create')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">nombre</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ingredientes as $data)
                    <tr>
                        <td class="border px-4 py-2">{{ $data->id }}</td>
                        <td class="border px-4 py-2">{{ $data->nombre }}</td>
                        <td class="border px-4 py-2">
                            <button wire:click="edit({{ $data->id }})"
                                class=" px-4 py-2 bg-gray-500 text-gray-900 cursor-pointer">Editar</button>
                            <button wire:click="delete({{ $data->id }})"
                                class=" px-4 py-2 bg-red-100 text-gray-900 cursor-pointer">Eliminar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
