 <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">

     <div class="intro-y col-span-12 lg:col-span-9">

         <div class="post intro-y overflow-hidden box" x-data="{}">

             <div class="post__tabs nav nav-tabs flex-col sm:flex-row bg-gray-300 dark:bg-dark-2 text-gray-600" role="tablist">
                 <a wire:click.prevent="setTabActive('tabProducts')" title="Productos Agregados" data-toggle="tab" data-target="#tabProducts" href="javascript:;" class="tooltip w-full sm:w-50 py-4 text-center flex justify-center items-center {{$tabProducts ? 'active' : '' }}" id="content-tab" role="tab" aria-controls="content" aria-selected="true"> <i class="fas fa-cart-arrow-down fa-lg mr-2"></i> DETALLE DE VENTA (F2)</a>
                 <a wire:click.prevent="setTabActive('tabSearch')" @click="setTimeout(() => { $refs.searchInput.focus() }, 600)" title="Seleccionar Categoría" data-toggle="tab" data-target="#tabSearch" href="javascript:;" class="tooltip w-full sm:w-50 py-4 text-center flex justify-center items-center {{$tabSearch ? 'active' : '' }}" id="meta-title-tab" role="tab" aria-selected="false"> <i class="fas fa-search fa-lg mr-2"></i> BUSCADOR DE PRODUCTOS (F3) </a>
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
                                         @forelse($contentCart as $item)
                                         <tr class="bg-gray-200 dark:bg-dark-1 text-lg">
                                             <td class="border-b whitespace-nowrap" width="10%">
                                                 <div class="w-10 h-10 image-fit">
                                                     <img alt="photo" class="w-full rounded-lg" src="{{ asset($item->photo) }}" data-action="zoom">
                                                 </div>
                                             </td>

                                             <td class="border-b dark:border-dark-5 ">
                                                 {{strtoupper($item->name)}}
                                                 <div>
                                                     <small class="text-theme-29">
                                                         stock: {{$item->currentstock - $item->qty}}
                                                     </small>
                                                 </div>
                                             </td>
                                             <td class="border-b dark:border-dark-5 text-center">${{number_format($item->price1,2)}}</td>
                                             <td class="border-b dark:border-dark-5 text-center">
                                                 <div class="input-group mt-2">
                                                     <input id="r{{$item->id}}" wire:keydown.enter="updateQty({{$item->id}}, $event.target.value )" wire:change="updateQty({{$item->id}}, $event.target.value )" value="{{$item->qty}}" type="number" class="form-control text-center ">

                                                 </div>
                                             </td>
                                             <td class="border-b dark:border-dark-5 text-center">${{number_format($item->price1 * $item->qty,2)}}</td>
                                             <td>
                                                 <div class="inline-flex" role="group" style="font-size: 1.2em!important;">
                                                     <button wire:click.prevent="removeFromCart({{$item->id}})" class="btn btn-danger"><i class="fas fa-trash "></i></button>
                                                     <button wire:click.prevent="decreaseQty({{$item->id}})" class="btn btn-warning ml-4"><i class="fas fa-minus "></i></button>
                                                     <button wire:click.prevent="increaseQty({{$item->id}})" class="btn btn-success ml-4"><i class="fas fa-plus "></i></button>
                                                 </div>
                                             </td>
                                         </tr>
                                         @empty
                                         <tr>
                                             <td colspan="5" class="text-center">AGREGA PRODUCTOS AL CARRITO</td>
                                         </tr>
                                         @endforelse
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