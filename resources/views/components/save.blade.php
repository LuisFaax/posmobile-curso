<button wire:click.prevent="Store" wire:loading.attr="disabled" class="btn btn-primary" type="button">
    <span wire:loading.remove>
        Guardar F4
    </span>
    <span wire:loading>
        {{ $slot }}
    </span>
    <div wire:loading wire:target="Store" wire:ignore>
        <i data-loading-icon="oval" data-color="white" class="w-4 h-4 ml-2 saving"></i>
    </div>
</button>