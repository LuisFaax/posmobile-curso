<div>
    <h2 class="intro-y text-lg font-medium mt-10">
        {{ $componentName }}
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="javascript:;" onclick="openModal()" class="btn btn-primary shadow-md mr-2">Agregar F2</button>


                <div class="hidden md:block mx-auto text-gray-600">-</div>

                <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-gray-700 dark:text-gray-300">
                        <input wire:model="search" type="text" class="form-control w-56 box pr-10 placeholder-theme-13" placeholder="Buscar...">
                        <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                    </div>
                </div>
        </div>
        <!-- BEGIN: Users Layout -->
        @forelse($clients as $c)
        <div class="intro-y col-span-12 md:col-span-6 lg:col-span-4" wire:key="uniqid()">
            <div class="box">
                <div class="flex items-start px-5 pt-5">
                    <div class="w-full flex flex-col lg:flex-row items-center">
                        <div class="w-16 h-16 image-fit">
                            <img alt="logo customer" class="rounded-full" src="dist/images/profile-1.jpg">
                        </div>
                        <div class="lg:ml-4 text-center lg:text-left mt-3 lg:mt-0">
                            <a href="" class="font-medium">{{ $c->name }}</a>
                            <div class="text-gray-600 text-xs mt-0.5">Crédito: {{ $c->credit }}</div>
                        </div>
                    </div>

                </div>
                <div class="text-center lg:text-left p-5">
                    <div>Compras Totales: ${{ number_format($c->customer->history_purchasings,2) }}</div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-5"> Compras a Crédito: ${{number_format($c->customer->credit_purchasings,2)}} </div>
                    <div class="flex items-center justify-center lg:justify-start text-gray-600 mt-1"> Adeudo Actual: ${{number_format($c->customer->pending_pay,2)}} </div>
                </div>
                <div class="text-center lg:text-right p-5 border-t border-gray-200 dark:border-dark-5">
                    @if($c->customer->purchasings->count() <1) <button class="btn btn-dark py-1 px-2 mr-2" title="Eliminar Cliente"><i class="fas fa-trash mr-1"></i>Eliminar</button>
                        @endif
                        <button onclick="edit({{ $c->id }})" class="btn btn-dark py-1 px-2" title="Editar Info"><i class="fas fa-pencil-alt mr-1"></i>Editar</button>

                        <livewire:payment :customerId="$c->customer_id" :saleId="$c->id" :wire:key="uniqid()" />

                        <button class="btn btn-dark py-1 px-2 py-1 px-2" title="Liquidar Cuenta"><i class="fas fa-pencil-alt mr-1"></i>Liquidar</button>


                </div>
            </div>
        </div>
        @empty
        <span>SIN CLIENTES</span>
        @endforelse
        <!-- END: Users Layout -->
        <!-- BEGIN: Pagination -->

        <!-- END: Pagination -->
    </div>
    <div class="col-sm-12 mt-2">
        {{ $clients->links() }}
    </div>
    @include('livewire.customers.modal')
    @include('components.script')


    <script>
        function edit(id) {
            @this.Edit(id)
        }
    </script>
</div>