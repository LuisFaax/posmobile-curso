 <script src="{{ asset('dist/js/app.js') }}"></script>
 <script src="{{ asset('js/alpine.js') }}"></script>
 <script src="{{ asset('js/snackbar.min.js') }}"></script>
 <script src="{{ asset('js/sweetalert.js') }}"></script>
 <script src="{{ asset('js/money.js') }}"></script>

 <script>
     window.addEventListener('noty', event => {
         Snackbar.show({
             text: event.detail.msg,
             actionText: 'CERRAR',
             actionTextColor: '#fff',
             backgroundColor: event.detail.type == 'success' ? '#2187EC' : '#e7515a',
             pos: 'top-right'
         })
         this.closeModal()
     })

     window.addEventListener('open-modal', event => {
         this.openModal()
     })


     function openModal() {
         var modal = document.getElementById("myModal")
         modal.classList.add("overflow-y-auto", "show")
         modal.style.cssText = "margin-top: 0px; margin-left: 0px; padding-left:17px; z-index: 10000;"
     }

     function closeModal() {
         var modal = document.getElementById("myModal")
         modal.classList.add("overflow-y-auto", "show")
         modal.style.cssText = ""
         window.livewire.emit('resetUI')
     }
 </script>