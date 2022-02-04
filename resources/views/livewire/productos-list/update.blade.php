<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4"> 
                    <div class="flex-1 py-6 overflow-y-auto px-4 sm:px-6">
                      <div class="flex items-start justify-between">
                        <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Detalle producto</h2>
                        <div class="ml-3 h-7 flex items-center">
                          <button wire:click="closeModalPopover()" type="button" class="-m-2 p-2 text-gray-400 hover:text-gray-500">
                            <span class="sr-only">Cerrar</span> 
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                          </button>
                        </div>
                      </div>
          
                      <div class="mt-8">
                        <div class="flow-root">
                          <ul role="list" class="-my-6 divide-y divide-gray-200">
                            <li class="py-6 flex">
                              <div class="flex-shrink-0 w-24 h-24 border border-gray-200 rounded-md overflow-hidden">
                                <img src="{{ asset("app/img/$imagenEdit" )}}" alt="Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt." class="w-full h-full object-center object-cover">
                              </div>
          
                              <div class="ml-4 flex-1 flex flex-col">
                                <div>
                                  <div class="flex justify-between text-base font-medium text-gray-900">
                                    <h3>
                                      <a href="#"> {{ $nombre }} </a>
                                    </h3>
                                    <p class="ml-4">$ {{ $valor }}</p>
                                  </div>
                                  <p class="mt-1 text-sm text-gray-500">{{ $descripcion }}</p> <hr>
                                </div>
                                <div class="flex-1 flex items-end justify-between text-sm">
                                    <div class="mb-4">
                                        <label for="exampleFormControlInput2"
                                            class="block text-gray-700 text-sm font-bold mb-2">Cantidad:</label>
                                        <input type="number" wire:change="changeValor($event.target.value)"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            id="exampleFormControlInput2" wire:model="cantidad" placeholder="Enter cantidad"></textarea>
                                        @error('cantidad') <span class="text-red-500">{{ $message }}</span>@enderror
                                    </div> 
                                </div>
                              </div>
                            </li>  
                            <!-- More products... -->
                          </ul>
                        </div>
                      </div>
                    </div> 
                    <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                      <div class="flex justify-between text-base font-medium text-gray-900">
                        <p>Subtotal</p>
                        <p>${{ $valorCal }}</p>
                      </div>    
                      <div class="flex justify-between text-base font-medium text-gray-900">
                        <p>Iva</p>
                        <p>${{ $valorCal * 0.15 }}</p>
                      </div>
                      <div class="flex justify-between text-base font-medium text-gray-900">
                        <p>Total</p>
                        <p>${{ $valorCal + ($valorCal * 0.15) }}</p>
                      </div> 
                    </div> 
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="store()" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-bold text-white shadow-sm hover:bg-red-700 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Agregar
                        </button>
                    </span>
                    <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="closeModalPopover()" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-bold text-gray-700 shadow-sm hover:text-gray-700 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Cerrar
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
 