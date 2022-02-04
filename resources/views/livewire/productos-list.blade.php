<div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
    <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Productos</h2>
    @if($isModalOpen)
        @include('livewire.productos-list.update')
    @endif
    <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
      @foreach ($pizzasI as $key)
       <!-- More products... -->
    
       <div wire:click="edit({{ $key->id }})" class="group relative">
          <div class="w-full min-h-80 bg-gray-200 aspect-w-1 aspect-h-1 rounded-md overflow-hidden group-hover:opacity-75 lg:h-80 lg:aspect-none">
            <img src="{{ asset("app/img/$key->imagen" )}}" alt="Front of men&#039;s Basic Tee in black." class="w-full h-full object-center object-cover lg:w-full lg:h-full">
          </div>
          <div class="mt-4 flex justify-between">
            <div>
              <h3 class="text-sm text-gray-700">
                <p>
                  <span aria-hidden="true" class="absolute inset-0"></span>
                  {{ $key->pizza }}
                </p>
              </h3>
              <p class="mt-1 text-sm text-gray-500">{{ $key->descripcion }}</p>
              <br>
              <hr>
              <button
              class="my-4 inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base font-bold text-white shadow-sm hover:bg-red-700">
              Agregar
                </button>

            </div>
            <p class="text-sm font-medium text-gray-900">${{ $key->costo }}</p>
          </div>
        </div>
        
        <!-- More products... -->
      @endforeach
     
    </div>
  </div>