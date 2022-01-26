<div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            {{$componentName}}
        </h2>
        <!-- Add button -->
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button wire:click.prevent="AddNew" class="btn btn-primary btnmodal">Agregar F2</button>
        </div>
    </div>

    <!-- Table -->
    <div class="intro-y box p-5 mt-5">
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            <form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto">

                <!-- Search -->
                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <input wire:model="search" id="search" type="text" class="form-control sm:w-40 xxl:w-full mt-2 sm:mt-0" placeholder="Buscar F8">
                </div>
                <div class="mt-2 xl:mt-0">
                    <button id="tabulator-html-filter-go" type="button" class="btn btn-primary w-full sm:w-16">Ir</button>
                </div>
            </form>
            <!-- Export options -->
            <div class="flex mt-5 sm:mt-0">
                <button id="tabulator-print" class="btn btn-outline-secondary w-1/2 sm:w-auto mr-2"> <i class=" fa fa-print w-4 h-4 mr-2"></i> Imprimir </button>
                <div class="dropdown w-1/2 sm:w-auto">
                    <button class="dropdown-toggle btn btn-outline-secondary w-full sm:w-auto" aria-expanded="false"> <i class="far fa-file w-4 h-4 mr-2"></i> Exportar </button>
                    <div class="dropdown-menu w-40">
                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                            <a id="tabulator-export-json" href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i class="far fa-file-pdf w-4 h-4 mr-2"></i> Exportar PDF </a>
                            <a id="tabulator-export-xlsx" href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i class="far fa-file-excel w-4 h-4 mr-2"></i> Export EXCEL </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content content -->
        <div class="overflow-x-auto scrollbar-hidden">
            <div class="overflow-x-auto mt-5">
                <table class="table mb-5">
                    <thead>
                        <tr>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"></th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">DESCRIPCIÓN</th>
                            <th class="border-b-2 dark:border-dark-5 text-center">CÓDIGO</th>
                            <th class="border-b-2 dark:border-dark-5 text-center">COSTO</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">PRECIO GRAL</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">PRECIO MAY</th>
                            <th class="border-b-2 dark:border-dark-5 text-center">STOCK</th>
                            <th class="border-b-2 dark:border-dark-5 text-center">MINSTOCK</th>
                            <th class="border-b-2 dark:border-dark-5 text-center">CATEGORÍA</th>
                            <th class="border-b-2 dark:border-dark-5 text-center">U.MEDIDA</th>
                            <th class="border-b-2 dark:border-dark-5 text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data iteration -->
                        @forelse($data as $d)

                        <tr class="{{ $loop->index % 2 ? 'bg-gray-200 dark:bg-dark-1' : '' }}">
                            <td class="border-b whitespace-nowrap" width="10%">
                                <div class="w-8 h-8 image-fit">
                                    <img alt="photo" class="w-full rounded-lg" src="{{ asset($d->photo) }}">
                                </div>
                            </td>
                            <td class="border-b whitespace-nowrap" width="70%">
                                <p class="uppercase">{{$d->name}}</p>
                                <p class="text-xs text-gray-500">Ventas {{$d->sales->count()}}</p>
                            </td>
                            <td class="text-center" width="10%">{{ $d->code }}</td>
                            <td class="text-center" width="10%">${{ number_format($d->cost,2) }}</td>
                            <td class="text-center" width="10%">${{ number_format($d->price1,2) }}</td>
                            <td class="text-center" width="10%">${{ number_format($d->price2,2) }}</td>
                            <td class="text-center" width="10%">
                                <span class="{{$d->minstock >= $d->stock ? 'text-theme-21 font-semibold' : ''}}">
                                    {{$d->stock}}
                                </span>

                            </td>
                            <td class="text-center" width="10%">{{$d->minstock}}</td>
                            <td class="text-center" width="10%">{{$d->category}}</td>
                            <td class="text-center" width="10%">{{$d->measure}}</td>

                            <td class="border-b whitespace-nowrap" width="10%">
                                @if($d->sales->count()<1) <button wire:key="{{ $d->id }}" wire:click.prevent="$emit('deleteRow',{{$d->id}})" class="btn btn-secondary mr-1">
                                    <i class="fa fa-trash w-4 h-4"></i>
                                    </button>
                                    @endif

                                    <button wire:click.prevent="Edit({{$d->id}})" class="btn btn-secondary mr-1">
                                        <i class="fa fa-edit w-4 h-4"></i>
                                    </button>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">Sin Resultados</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <!-- Pagination styles -->
                {{$data->links()}}
            </div>
        </div>
    </div>
    <!-- END: HTML Table Data -->



    @include('livewire.products.modal')


</div>
@include('components.script')


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // configuration
        const args = {
            afterFormat(e) {
                //console.log('afterFormat: ', e);
            },
            allowNegative: false,
            beforeFormat(e) {
                //console.log('beforeFormat: ', e);
            },
            negativeSignAfter: false,
            prefix: '',
            suffix: '',
            fixed: true,
            fractionDigits: 2,
            decimalSeparator: '.',
            thousandsSeparator: ',',
            cursor: 'move'
        }

        // get elements with money class
        const inputs = document.querySelectorAll('.money')
        // set money mask
        inputs.forEach(element => {
            SimpleMaskMoney.setMask(element, args)
        })


    })
</script>