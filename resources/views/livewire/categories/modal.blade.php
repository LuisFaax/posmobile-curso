<div wire:ignore.self id="myModal" class="modal modal-slide-over" data-backdrop="static" tabindex="-1">

    <div class="modal-dialog">
        <div class="modal-content">
            <a href="javascript:;" data-dismiss="modal"><i class="fas fa-times fa-2x w-8 h-8 text-gray-500"></i></a>

            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Gestión de Categorías</h2>
            </div>


            <div class="modal-body">
                <div x-data="{}" @open-modal.window="setTimeout(() => { $refs.first.focus() }, 900)">
                    <label>Descripción</label>
                    <input type="text" wire:model.defer="name" x-ref="first" wire:keydown.enter="Store" wire:loading.attr="disabled" class="form-control" placeholder="ej: Pinzas">
                    @error('name') <span class="text-theme-15">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="modal-footer text-right w-full absolute bottom-0">
                <button onclick="closeModal()" class="btn btn-outline-secondary">Cancelar Esc</button>
                <button wire:click.prevent="Store" wire:loading.attr="disabled" class="btn btn-primary" type="button">
                    <span wire:loading.remove>
                        Guardar F4
                    </span>
                    <span wire:loading>
                        {{ $selected_id >0 ? 'Actualizando' : 'Guardando'  }}
                    </span>
                    <div wire:loading wire:target="Store" wire:ignore>
                        <i data-loading-icon="oval" data-color="white" class="w-4 h-4 ml-2 saving"></i>
                    </div>
                </button>
            </div>

        </div>
    </div>






</div>