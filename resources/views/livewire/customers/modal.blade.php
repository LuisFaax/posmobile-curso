<div id="modalUser">
    <x-modal>
        <x-slot name="title">Gestionar Clientes</x-slot>

        <x-slot name="form">

            <!-- user name -->
            <div class="col-span-12">
                <label class="form-label">Nombre</label>
                <input type="text" wire:model.defer="name" class="form-control" placeholder="ej: Tienda X">
                @error('name') <span class="text-theme-15">{{ $message }}</span> @enderror
            </div>
            <!-- phone -->
            <div class="col-span-6">
                <label class="form-label">Teléfono</label>
                <input type="text" wire:model.defer="phone" class="form-control" placeholder="ej: 351 0000 000" maxlength="10">
                @error('phone') <span class="text-theme-15">{{ $message }}</span> @enderror
            </div>
            <!-- estatus -->
            <div class="col-span-6">
                <label class="form-label">Estatus</label>
                <select wire:model.lazy="status" class="form-select form-select-md  sm:mr-2">
                    <option value="Elegir" selected disabled>Elegir</option>
                    <option value="Active">Activo</option>
                    <option value="Locked">Bloqueado</option>
                </select>
                @error('status') <span class="text-theme-15">{{ $message }}</span> @enderror
            </div>
            <!-- email -->
            <div class="col-span-12">
                <label class="form-label">Crédito</label>
                <input type="number" wire:model.defer="credit" class="form-control" placeholder="0.00">
                @error('credit') <span class="text-theme-15">{{ $message }}</span> @enderror
            </div>
            <!-- address -->
            <div class="col-span-12">
                <label class="form-label">Dirección</label>
                <textarea wire:model.defer="address" cols="30" rows="3" class="form-control"></textarea>
                @error('address') <span class="text-theme-15">{{ $message }}</span> @enderror
            </div>


        </x-slot>

        <x-slot name="button">
            <x-save>
                {{$selected_id >0 ? 'Actualizando' : 'Guardando'}}
            </x-save>
        </x-slot>

    </x-modal>

</div>