 <div id="tabSearch" class="tab-pane p-5 {{$tabSearch ? 'active' : '' }}" role="tabpanel">

     <div class="grid grid-cols-12">
         <div class="col-span-12">
             <div class="input-group">
                 <div id="input-group-3 " class="input-group-text">
                     <i class="fas fa-search fa-lg"></i>
                 </div>
                 <input wire:model="searchByName" wire:keydown.enter="$emit('scan', $this.target.value )" x-ref="searchInput" id="searchByName" type="text" class="form-control form-control-lg bg-theme-17" placeholder="Puedes buscar por código, nombre o descripción del producto ( F3 )">
             </div>
         </div>
     </div>

     <div class="intro-y grid grid-cols-12 gap-3 sm:gap-4 mt-2">


         <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
             <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">

                 <a href="javascript:;" class="w-3/5 file__icon file__icon--image mx-auto">
                     <div class="file__icon--image__preview image-fit">
                         <img alt="img" src="">
                     </div>
                 </a>
                 <a href="javascript:;" class="block font-medium mt-4 text-center truncate"></a>
                 <h1 class="text-center"></h1>
             </div>
         </div>
         <!--
         <div class="col-span-12">
             <h1 class="text-center text-theme-6 w-full">SIN RESULTADOS</h1>
         </div>-->



     </div>
 </div>