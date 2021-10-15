<script>
    document.addEventListener('livewire:load', function() {

        // leer el valor de una propiedad del back desde javascript        
        //var medida  = @this.name
        // asignar valor a nuestra propiedad pública desde javascript
        //@this.name = 'Piezas'

        @this.on('deleteRow', rowId => {
            Swal.fire({
                title: '¿CONFIRMAS?',
                text: '¿EL REGISTRO SE ELIMINARÁ PERMANENTEMENTE?',
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Si, Eliminar!'
            }).then((result) => {
                if (result.value) {
                    @this.call('Destroy', rowId)
                } else {
                    Swal.fire({
                        title: 'Operación cancelada',
                        icon: 'success'
                    })
                }
            })
        })


        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                closeModal()
            }
            if (event.key === "F2") {
                @this.AddNew()
            }
            if (event.key === "F4") {
                @this.Store()
            }

            if (event.key === "F8") {
                document.getElementById('search').focus()
            }
            if (event.key === "F9") {
                var table = document.getElementById('mytable')
                var row = table.rows[1]
                @this.Edit(row.id)
            }


        })


    })
</script>