<div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            CUENTAS POR COBRAR
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            {{-- <button wire:click.prevent="AddNew" class="btn btn-primary shadow-md mr-2">Agregar F2</button> --}}

        </div>
    </div>
    <!-- BEGIN: HTML Table Data -->
    <div class="intro-y box p-5 mt-5">
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            <form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto">


                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <input wire:model="search" type="text" id="search" wire:keydown.enter.prevent
                        class="form-control sm:w-40 xxl:w-full mt-2 sm:mt-0" placeholder="Buscar F8">
                </div>

            </form>
            <div class="flex mt-5 sm:mt-0">
                <button id="tabulator-print" class="btn btn-outline-secondary w-1/2 sm:w-auto mr-2"> <i
                        class="fa fa-print w-4 h-4 mr-2"></i> Imprimir </button>
                <div class="dropdown w-1/2 sm:w-auto">
                    <button class="dropdown-toggle btn btn-outline-secondary w-full sm:w-auto" aria-expanded="false"> <i
                            class="fa fa-file w-4 h-4 mr-2"></i> Exportar </button>
                    <div class="dropdown-menu w-40">
                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                            <a id="tabulator-export-csv" href="javascript:;"
                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i class="far fa-file-excel w-4 h-4 mr-2"></i> Exportar EXCEL </a>
                            <a id="tabulator-export-json" href="javascript:;"
                                class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md">
                                <i class="far fa-file-pdf w-4 h-4 mr-2"></i> Exportar PDF </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto scrollbar-hidden">
            <div class="overflow-x-auto mt-5">
                <table class="table mb-5" id="mytable">
                    <thead>
                        <tr>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">#</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">CUSTOMER</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">TOTAL</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">MODE</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">PAGOS</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">ADEUDO</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse($sales as $sale)
                        <tr id="{{$sale->id}}" class="{{ $loop->index % 2 ? 'bg-gray-200 dark:bg-dark-1' : '' }}">

                            <td class="whitespace-nowrap">{{$sale->id}}</td>
                            <td class="whitespace-nowrap">{{$sale->customer->user->name }}</td>
                            <td class="whitespace-nowrap">${{ number_format($sale->total,2) }}</td>
                            <td class="whitespace-nowrap">{{ $sale->mode }}</td>
                            <td class="whitespace-nowrap">${{ number_format($sale->pays->sum('amount'),2 ) }}</td>
                            <td class="whitespace-nowrap">${{ $sale->pendingpay }}</td>


                            <td class="whitespace-nowrap" width="10%">
                                <button onclick="balancePay({{ $sale->id }})" class="btn btn-secondary">
                                    <i class="fa fa-check w-4 h-4"></i>
                                </button>

                                <button class="btn btn-secondary" wire:click.prevent="modalPay({{ $sale->id }})">
                                    <i class="fa fa-dollar-sign w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td>Sin Resultados</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{$sales->links()}}
            </div>
        </div>
    </div>
    <!-- END: HTML Table Data -->
    <div wire:ignore.self id="modalPayments" class="modal" data-backdrop="static" tabindex="-1">
        <div class="modal-dialog ">
            <div class="modal-content">

                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">
                        Ingresar Pago
                    </h2>
                </div>

                <div class="modal-body grid gap-4">
                    <!-- monto del abono -->
                    <div class="col-span-12">
                        <label class="form-label">Ingresa el Monto</label>
                        <input type="number" wire:model="amount" class="form-control" placeholder="ej: 200.00">
                        @error('amount') <span class="text-theme-15">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="modal-footer text-right">
                    <button type="button" onclick="closeModalPay()"
                        class="btn btn-outline-secondary mr-1">Cancelar</button>

                    @if($amount > 0)
                    <button wire:click.prevent="doPayment" type="button" class="btn btn-primary">
                        Guardar
                    </button>
                    @endif

                </div>

            </div>
        </div>
    </div>

    @include('components.script')


    <script>
        function balancePay(sale_id) {
        Swal.fire({
        text: "¿CONFIRMAS PAGAR EL SALDO PENDIENTE DE LA CUENTA?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#e7515a',
        cancelButtonText: 'Cerrar',
        padding: '2em'
        }).then(function(result) {
        if (result.value) {
        @this.balancePay(sale_id)
        swal.close()
        }
        })
    }


    window.addEventListener('balance-modal-pay', event => {
        openModalPay()
        })
    
    window.addEventListener('close-balance-modal-pay', event => {
        closeModalPay()
    })

    function openModalPay() {
    var modal = document.getElementById("modalPayments")
    modal.classList.add("overflow-y-auto", "show")
    modal.style.cssText = "margin-top: 0px; margin-left: 0px; padding-left: 17px; z-index: 10000;"
    }
    
    function closeModalPay() {
    var modal = document.getElementById("modalPayments")
    modal.classList.remove("overflow-y-auto", "show")
    modal.style.cssText = ""
    
    }

    </script>

</div>