<script>
    function CancelSale() {
        Swal.fire({
            text: '¿CONFIRMAS CANCELAR LA VENTA?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#e7515a',
            cancelButtonText: 'Cerrar',
            padding: '2em'
        }).then(function(result) {
            if (result.value) {
                @this.cancelSale()
                swal.close()
            }
        })
    }




    function openModalCustomer() {
        var modal = document.getElementById('modalCustomers')
        modal.classList.add("overflow-y-auto", "show")
        modal.style.cssText = "margin-top: 0px; margin-left: -100px; z-index: 10000"

        setTimeout(() => {
            document.getElementById('customer-search').focus()
        }, 650)
    }

    function closeModalCustomer() {
        var modal = document.getElementById('modalCustomers')
        modal.classList.remove("overflow-y-auto", "show")
        modal.style.cssText = ""
    }

    window.addEventListener('close-customer-modal', event => {
        closeModalCustomer()
        @this.saleType = 'CASH'
    })

    function openModalSaleSave() {
        var modal = document.getElementById('modalSaveSale')
        modal.classList.add("overflow-y-auto", "show")
        modal.style.cssText = "margin-top: 0px; margin-left: -100px; z-index: 10000"
    }

    function closeModalSaveSale() {
        var modal = document.getElementById('modalSaveSale')
        modal.classList.remove("overflow-y-auto", "show")
        modal.style.cssText = ""
    }
</script>