<x-slot name="header">
    <h2 class="text-center">Pizza Categoria</h2>
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
                Create Pizza
            </button>
            @if($isModalOpen)
            @include('livewire.pizza-ingredientes.create')
            @endif
            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 w-20">No.</th>
                        <th class="px-4 py-2">nombre</th>
                        <th class="px-4 py-2">descripcion</th>
                        <th class="px-4 py-2">ingredientes</th>
                        <th class="px-4 py-2">costo</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $id = '0'; @endphp
                    @foreach($pizzasI as $data)
                    @php $ingreG = ""; $idI = "0";  @endphp
                        @if ($id != $data->pizza_id)
                        <tr>
                            <td class="border px-4 py-2">{{ $data->id }}</td>
                            <td class="border px-4 py-2">{{ $data->pizza }}</td>
                            <td class="border px-4 py-2">{{ $data->descripcion}}</td>
                            <td class="border px-4 py-2">
                                @foreach($ingrediente as $d)
                                    @if ($idI != $d->id)
                                        @php $idI = $d->ingrediente_id; $ingreG = $d->nombre; @endphp
                                        {{$ingreG . ' '}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="border px-4 py-2">{{ $data->costo}}</td>
                            <td class="border px-4 py-2">
                                <button wire:click="edit({{ $data->id }})"
                                    class=" px-4 py-2 bg-gray-500 text-gray-900 cursor-pointer">Editar</button>
                                <button wire:click="delete({{ $data->id }})"
                                    class=" px-4 py-2 bg-red-100 text-gray-900 cursor-pointer">Eliminar</button>
                            </td>
                        </tr>
                        @php $id = $data->pizza_id; @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>