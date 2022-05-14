<div class="col-span-12 lg:col-span-3">
    <div class="box p-5">
        <div>
            <h2 class="text-2xl text-center mb-5">Resumen de Venta</h2>
            <button onclick="openModalCustomer()" class="btn btn-outline-dark w-full mb-3 ">
                <i class="{{ $customerSelected == 'Seleccionar Cliente F8' ? 'fas fa-user-plus fa-lg mr-2' : 'fas fa-user-check fa-lg mr-2' }}"></i>
                {{ $customerSelected }}
            </button>
        </div>
        <div class="grid grid-cols-3 mt-5">
            <div class="col-span-1">
                <h1 class="text-theme-15 text-2xl font-bold">Articulos</h1>
            </div>
            <div class="col-span-2">
                <h3 class="text-2xl text-right">{{$itemsCart}}</h3>
            </div>
            <div class="col-span-1 pt-5">
                <h1 class="text-theme-15 text-2xl font-bold">TOTAL</h1>
            </div>
            <div class="col-span-2 pt-5">
                <h3 class="text-2xl text-right">${{ number_format($totalCart,2) }}</h3>
            </div>

            @if($totalCart > 0)
            <div class="col-span-3 mt-5">
                <button onclick="openModalSaleSave()" class="btn btn-primary w-full">
                    <i class="fas fa-cash-register fa-lg mr-2"></i> Abrir Caja F4</button>
            </div>

            <div class="col-span-3 mt-5">
                <button onclick="CancelSale()" class="btn btn-danger w-full">
                    <i class="fas fa-times fa-lg mr-2"></i> Cancelar (Supr)
                </button>
            </div>
            @endif

        </div>





    </div>
</div>