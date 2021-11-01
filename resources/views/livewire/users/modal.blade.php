<div id="modalUser">
    <x-modal >
        <x-slot name="title">
            Gestionar Usuarios
        </x-slot>

        <x-slot name="form">

        <!-- user name -->
        <div class="col-span-12">
            <label  class="form-label">Nombre</label>
            <input  type="text" class="form-control" placeholder="ej: Terminator">
        </div>
        <!-- phone -->
        <div class="col-span-6">
            <label  class="form-label">Teléfono</label>
            <input  type="text" class="form-control" placeholder="ej: 351 0000 000" maxlength="10">
        </div>
        <!-- estatus -->
        <div class="col-span-6">
            <label  class="form-label">Estatus</label>
            <select wire:model.defer="categoryid" class="form-select form-select-md  sm:mr-2">
                <option value="Elegir" selected disabled>Elegir</option>
                <option value="Active"  >Activo</option>
                <option value="Locked"  >Bloqueado</option>
            </select>
        </div>
        <!-- email -->
        <div class="col-span-12">
            <label  class="form-label">Email</label>
            <input  type="text" class="form-control" placeholder="ej: luisfaax@gmail.com">
        </div>
        <!-- password -->
        <div class="col-span-12">
            <label  class="form-label">Password</label>
            <input  type="password" class="form-control" placeholder="..." autocomplete="new-password">
        </div>
        <!-- address -->
        <div class="col-span-12">
            <label  class="form-label">Dirección</label>
            <textarea  cols="30" rows="3" class="form-control"></textarea>
        </div>
        <!-- avatar/photo -->
        <div class="col-span-12" >
            <label>Avatar</label>
            <input type="file" class="form-control" wire:model="photo" accept="image/x-png,image/jpeg,image/jpg" >
            @error('photo')
            <span style="color: red;">{{ $message }}</span>
            @enderror
            <div wire:loading wire:target="photo">Subiendo Imagen..</div>
        </div> 
        <!-- avatar preview -->
        <div class="col-span-12" id="avatar" >
            @if( $photo )                   
                <img class="rounded-lg mb-5 w-50" src="{{ $photo->temporaryUrl() }}">  
            @endif           
        </div>      

    </x-slot>

    <x-slot name="button">
       <x-save>
           {{$selected_id >0 ? 'Actualizando' : 'Guardando'}}
       </x-save>
    </x-slot>

    </x-modal>
</div>