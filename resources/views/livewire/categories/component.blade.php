<div>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            {{$componentName}}
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button wire:click.prevent="AddNew" class="btn btn-primary shadow-md mr-2">Agregar F2</button>

        </div>
    </div>
    <!-- BEGIN: HTML Table Data -->
    <div class="intro-y box p-5 mt-5">
        <div class="flex flex-col sm:flex-row sm:items-end xl:items-start">
            <form id="tabulator-html-filter-form" class="xl:flex sm:mr-auto">


                <div class="sm:flex items-center sm:mr-4 mt-2 xl:mt-0">
                    <input wire:model="search" type="text" id="search" wire:keydown.enter.prevent class="form-control sm:w-40 xxl:w-full mt-2 sm:mt-0" placeholder="Buscar F8">
                </div>

            </form>
            <div class="flex mt-5 sm:mt-0">
                <button id="tabulator-print" class="btn btn-outline-secondary w-1/2 sm:w-auto mr-2"> <i class="fa fa-print w-4 h-4 mr-2"></i> Imprimir </button>
                <div class="dropdown w-1/2 sm:w-auto">
                    <button class="dropdown-toggle btn btn-outline-secondary w-full sm:w-auto" aria-expanded="false"> <i class="fa fa-file w-4 h-4 mr-2"></i> Exportar </button>
                    <div class="dropdown-menu w-40">
                        <div class="dropdown-menu__content box dark:bg-dark-1 p-2">
                            <a id="tabulator-export-csv" href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i class="far fa-file-excel w-4 h-4 mr-2"></i> Exportar EXCEL </a>
                            <a id="tabulator-export-json" href="javascript:;" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white dark:bg-dark-1 hover:bg-gray-200 dark:hover:bg-dark-2 rounded-md"> <i class="far fa-file-pdf w-4 h-4 mr-2"></i> Exportar PDF </a>

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
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">DESCRIPCIÓN</th>
                            <th class="border-b-2 dark:border-dark-5 whitespace-nowrap">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $d)
                        <tr id="{{$d->id}}" class="{{ $loop->index % 2 ? 'bg-gray-200 dark:bg-dark-1' : '' }}">
                            <td class="whitespace-nowrap" width="10%">{{$d->id}}</td>
                            <td class="whitespace-nowrap" width="80%">
                                <p class="uppercase">{{$d->name}}</p>
                                <p class="text-xs text-gray-500">Productos {{$d->products->count()}}</p>
                            </td>
                            <td class="whitespace-nowrap" width="10%">
                                <button class="btn btn-secondary" wire:click.prevent="$emit('deleteRow', {{$d->id}})">
                                    <i class="fa fa-trash w-4 h-4"></i></button>
                                <button class="btn btn-secondary" wire:click.prevent="Edit({{$d->id}})">
                                    <i class="fa fa-edit w-4 h-4"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td>Sin Resultados</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                {{$data->links()}}
            </div>
        </div>
    </div>
    <!-- END: HTML Table Data -->
    @include('livewire.categories.modal')
    @include('components.script')
</div>