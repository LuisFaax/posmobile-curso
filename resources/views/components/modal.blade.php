<div wire:ignore.self id="myModal" class="modal" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Gestionar Usuario</h2>
            </div>
            <!-- END: Modal Header -->

            <!-- BEGIN: Modal Body -->
            <div class="modal-body grid gap-4">
                {{ $form }}
            </div> <!-- END: Modal Body -->

            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer text-right">
                <button type="button" onclick="closeModal()" class="btn btn-outline-secondary mr-1">Cancelar Esc</button>

                {{ $button }}

            </div>
            <!-- END: Modal Footer -->

        </div>
    </div>
</div>