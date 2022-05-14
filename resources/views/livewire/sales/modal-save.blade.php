    <div wire:ignore.self id="modalSaveSale" class="modal" data-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">
                        <b class="text-theme-1">Registrar Venta</b>
                    </h2>
                </div>

                <div class="modal-body">
                    <div class="grid grid-cols-3">
                        <div class="col-span-1 pt-5">
                            <h1 class="text-theme-15 text-2xl font-bold">TOTAL</h1>
                        </div>
                        <div class="col-span-2 pt-5">
                            <h3 class="text-2xl text-right">${{number_format($totalCart,2)}}</h3>
                        </div>
                        <div class="col-span-1">
                            <h1 class="text-theme-15 text-2xl font-bold">Articulos</h1>
                        </div>
                        <div class="col-span-2">
                            <h3 class="text-2xl text-right">{{$itemsCart}}</h3>
                        </div>
                    </div>

                    <div class="mt-3 border-t border-gray-200 dark:border-dark-5"></div>

                    <div class="grid grid-cols-3 mt-5" x-data="{}">
                        <div class="col-span-1 pt-5">
                            <h1 class="text-theme-16 text-2xl ">Tipo de Venta</h1>
                        </div>
                        <div class="col-span-2 pt-5">
                            <select wire:model="saleType" x-on:change="setTimeout(() => $refs.inputAmount.focus(), 600)" class="form-select form-select-lg  sm:mr-2">
                                <option value="CASH">CONTADO</option>
                                <option value="CREDIT">CRÉDITO</option>
                            </select>
                            @if($saleType =='CREDIT' && $customerSelected == 'Seleccionar Cliente F8')
                            <span class="text-theme-29">Para dar anticipo selecciona el cliente</span>
                            @endif
                        </div>
                        @if($saleType =='CREDIT' && $customerSelected != 'Seleccionar Cliente F8')
                        <div class="col-span-1 pt-5">
                            <h1 class="text-theme-16 text-2xl ">Anticipo</h1>
                        </div>
                        <div class="col-span-2 mt-4">
                            <input wire:model="amount" type="number" x-ref="inputAmount" class="form-control" placeholder="0.00" max="{{$totalCart}}">
                            <span class="text-theme-29 {{$amount <= $totalCart ? 'hidden' : ''}}">EL ANTICIPO DEBE SER MENOR AL TOTAL</span>
                        </div>
                        @endif
                        <div class="col-span-1 pt-5">
                            <h1 class="text-theme-16 text-2xl ">Status de Venta</h1>
                        </div>
                        <div class="col-span-2 pt-5">
                            <select wire:model="statusSale" class="form-select form-select-lg  sm:mr-2">
                                <option value="Paid">Pagada</option>
                                <option value="Pending">Pendiente</option>
                                <option value="Cancelled">Cancelada</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="modal-footer text-right">

                    <button onclick="closeModalSaveSale()" class="btn btn-outline-secondary mr-5">CERRAR</button>

                    <button wire:click.prevent="Store(true)" wire:loading.attr="disabled" type="button" class="btn btn-warning">

                        <span wire:loading.remove wire:target="Store">
                            <i class="fas fa-print mr-2" style="color:white"></i> GUARDAR E IMPRIMIR
                        </span>

                        <x-spinner />

                    </button>


                    <button wire:click.prevent="Store" wire:loading.attr="disabled" type="button" class="btn btn-primary ml-3">
                        <span wire:loading.remove wire:target="Store">
                            <i class="fas fa-database mr-2"></i>GUARDAR VENTA F5
                        </span>

                        <x-spinner />

                    </button>

                </div>

            </div>
        </div>
    </div>