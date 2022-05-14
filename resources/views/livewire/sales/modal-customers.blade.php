    <div wire:ignore.self id="modalCustomers" class="modal" data-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">
                        <b class="text-theme-1">Buscar Cliente</b>
                    </h2>
                </div>

                <div class="modal-body grid gap-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="striped-rows-table">
                                <div class="preview">
                                    <div class="overflow-x-auto">
                                        <div class="input-group mt-2">
                                            <div class="input-group-text"><i class="fas fa-search"></i></div>
                                            <input wire:model="searchcustomer" id="customer-search" type="text" class="form-control form-control-lg " placeholder="Ingresa el nombre">
                                        </div>


                                        <table class="table mt-2">
                                            <thead>
                                                <tr class="text-theme-6">
                                                    <th class="border-b-2 dark:border-dark-5 whitespace-nowrap " width="80%">Nombre del Cliente</th>
                                                    <th class="border-b-2 dark:border-dark-5 "></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($customers as $customer)
                                                <tr class="text-lg {{$loop->index % 2 > 0 ? 'text-theme-15' : ''}}">
                                                    <td class="border-b dark:border-dark-5 ">
                                                        {{$customer->name}}
                                                    </td>
                                                    <td>
                                                        <button wire:click.prevent="setCustomer('{{$customer->name}}',{{$customer->id}})" class="btn btn-primary text-lg">Seleccionar</button>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="2" class="text-center">NO HAY CLIENTES REGISTRADOS</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer text-right">
                    <button onclick="closeModalCustomer()" class="btn btn-outline-secondary mr-5">CERRAR VENTANA</button>
                </div>

            </div>
        </div>
    </div>