<div wire:ignore.self id="myModal" class="modal modal-slide-over" data-backdrop="static" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <a data-dismiss="modal" href="javascript:;"> <i class="fas fa-times fa-2x w-8 h-8 text-gray-500"></i> </a>
            <!-- Modal title -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">
                    Gestión de Productos
                </h2>
                <!-- Close modal button -->
                <button type="button" onclick="closeModal()" class="btn btn-outline-secondary  mr-3">Cancelar</button>
                <!-- Save button -->
                <button wire:click.prevent="Store" wire:loading.attr="disabled" type="button" class="btn btn-primary ">
                    <span wire:loading.remove>
                        Guardar F4
                    </span>
                    <span wire:loading>
                        {{$selected_id >0 ? 'Actualizando' : 'Guardando'}}
                    </span>
                    <div wire:loading wire:target="Store" wire:ignore>
                        <i data-loading-icon="oval" data-color="white" class="w-4 h-4 ml-2 saving"></i>
                    </div>
                </button>
            </div>
            <!-- Content modal -->
            <div class="modal-body  ">

                <!-- Product Name -->
                <div x-data="{}" @open-modal.window="setTimeout(() => { $refs.first.focus() }, 900)">
                    <label class="form-label">Nombre</label>
                    <input wire:model.defer="name" x-ref="first" type="text" class="form-control" placeholder="ej: Pinzas" maxlength="50">
                    @error('name') <span class="text-theme-15">{{ $message }}</span> @enderror
                </div>
                <!-- Description -->
                <div>
                    <label class="form-label">Descripción</label>
                    <textarea wire:model.defer="description" cols="10" rows="2" class="form-control" placeholder="..." maxlength="255"></textarea>
                    @error('description') <span class="text-theme-15">{{ $message }}</span> @enderror
                </div>
                <!-- Barcode -->
                <div class="grid grid-cols-12 gap-2">
                    <div class="col-span-6">
                        <label class="form-label">Código</label>
                        <input wire:model.defer="code" type="text" class="form-control" placeholder="ej: 750100" maxlength="25">
                        @error('code') <span class="text-theme-15">{{ $message }}</span> @enderror
                    </div>
                    <!-- Cost -->
                    <div class="col-span-6">
                        <label class="form-label">Costo</label>
                        <input wire:model.defer="cost" type="text" class="form-control money" placeholder="0.00">
                        @error('cost') <span class="text-theme-15">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-2">
                    <!-- Public price -->
                    <div class="col-span-6">
                        <label class="form-label">Precio Gral</label>
                        <input wire:model.defer="price1" type="text" class="form-control money" placeholder="0.00">
                        @error('price1') <span class="text-theme-15">{{ $message }}</span> @enderror
                    </div>
                    <!-- Wholesale price -->
                    <div class="col-span-6">
                        <label class="form-label">Precio May</label>
                        <input wire:model.defer="price2" type="text" class="form-control money" placeholder="0.00">
                        @error('price2') <span class="text-theme-15">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-2">
                    <!-- Stock -->
                    <div class="col-span-6">
                        <label class=" form-label">Stock</label>
                        <input wire:model.defer="stock" type="text" class="form-control money" placeholder="0.00">
                        @error('stock') <span class="text-theme-15">{{ $message }}</span> @enderror
                    </div>
                    <!-- Minimun stock -->
                    <div class="col-span-6">
                        <label class="form-label">Min Stock</label>
                        <input wire:model.defer="minstock" type="text" class="form-control money" placeholder="0.00">
                        @error('minstock') <span class="text-theme-15">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-2">
                    <!-- Category -->
                    <div class="col-span-6">
                        <label class="form-label">Categoría</label>
                        <select wire:model.defer="categoryid" class="form-select form-select-md  sm:mr-2">
                            <option value="Elegir" selected disabled>Elegir</option>
                            @foreach($categories as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                            @endforeach
                        </select>
                        @error('categoryid') <span class="text-theme-15">{{ $message }}</span> @enderror
                    </div>
                    <!-- Measure -->
                    <div class="col-span-6">
                        <label class="form-label">Unidad de Medida</label>
                        <select wire:model.defer="measureid" class="form-select form-select-md  sm:mr-2">
                            <option value="Elegir" selected disabled>Elegir</option>
                            @foreach($measures as $m)
                            <option value="{{$m->id}}">{{$m->name}}</option>
                            @endforeach
                        </select>
                        @error('measureid') <span class="text-theme-15">{{ $message }}</span> @enderror
                    </div>
                </div>
                <!-- Images gallery -->
                <div class="grid grid-flow-col auto-cols-max md:auto-cols-min gap-2 mt-6">
                    <div>
                        <label>Imágenes</label>
                        <input type="file" class="form-control" wire:model="gallery" accept="image/x-png,image/jpeg" multiple>
                        @error('gallery.*')
                        <span style="color: red;">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Loading Message for Images -->
                    <div wire:loading wire:target="gallery">Subiendo Imagenes...</div>
                </div>

                <!-- Display images -->
                @if( !empty( $gallery ) )
                <div class="grid grid-cols-12 gap-3 mt-5 pt-5 border-t border-theme-31">
                    @foreach ( $gallery as $photo )
                    <a href="javascript:;" class="intro-y block col-span-2 sm:col-span-2 xxl:col-span-2">
                        <div class="box rounded-md p-3 relative">
                            <div class="flex-none pos-image relative block">
                                <div class="pos-image__preview ">
                                    <img src="{{ $photo->temporaryUrl() }}">
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>


                @endif

            </div>

        </div>

    </div>
</div>
</div>