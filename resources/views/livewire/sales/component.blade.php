 <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">

     <div class="intro-y col-span-12 lg:col-span-9">

         <div class="post intro-y overflow-hidden box" x-data="{}">

             <div class="post__tabs nav nav-tabs flex-col sm:flex-row bg-gray-300 dark:bg-dark-2 text-gray-600" role="tablist">
                 <a href="javascript:;" wire:click.prevent="setTabActive('tabProducts')" title="Productos Agregados" data-toggle="tab" data-target="#tabProducts" class="tooltip w-full sm:w-50 py-4 text-center flex justify-center items-center {{$tabProducts ? 'active' : '' }}" id="content-tab" role="tab" aria-controls="content" aria-selected="true"><i class="fas fa-cart-arrow-down fa-lg mr-2"></i> DETALLE DE VENTA (F2)</a>

                 <a wire:click.prevent="setTabActive('tabSearch')" title="Seleccionar Categoría / Buscar Productos" href="javascript:;" data-toggle="tab" data-target="#tabSearch" class="tooltip w-full sm:w-50 py-4 text-center flex justify-center items-center {{$tabSearch ? 'active' : '' }}" id="meta-title-tab" role="tab" aria-selected="false"> <i class="fas fa-search fa-lg mr-2"></i> BUSCADOR DE PRODUCTOS (F3) </a>

             </div>

             <div class="post__content tab-content">
                 <div id="tabProducts" class="tab-pane {{$tabProducts ? 'active' : '' }}" role="tabpanel" aria-labelledby="content-tab">

                     <div class="p-5" id="striped-rows-table">
                         <div class="preview">
                             <div class="overflow-x-auto">
                                 <table class="table">
                                     <thead>
                                         <tr class="text-theme-6">
                                             <th class="border-b-2 dark:border-dark-5 whitespace-nowrap"></th>
                                             <th class="border-b-2 dark:border-dark-5 whitespace-nowrap font-bold" width="60%">DESCRIPCIÓN</th>
                                             <th class="border-b-2 dark:border-dark-5 whitespace-nowrap font-bold">PRECIO</th>
                                             <th class="border-b-2 dark:border-dark-5 whitespace-nowrap font-bold text-center" width="17%">CANT</th>
                                             <th class="border-b-2 dark:border-dark-5 whitespace-nowrap font-bold">IMPORTE</th>
                                             <th class="border-b-2 dark:border-dark-5 whitespace-nowrap font-bold"></th>
                                         </tr>
                                     </thead>
                                     <tbody>


                                     </tbody>
                                 </table>
                             </div>
                         </div>

                     </div>
                 </div>
                 @include('livewire.sales.tabSearch')
             </div>
         </div>

     </div>

     @include('livewire.sales.resume')
     @include('livewire.sales.modal-customers')
     @include('livewire.sales.modal-save')
     @include('livewire.sales.scripts')

 </div>