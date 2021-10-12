 <div class="top-bar -mx-4 px-4 md:mx-0 md:px-0">
     <!-- BEGIN: Breadcrumb -->
     <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="">COMPONENT NAME</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">ACTION</a> </div>
     <!-- END: Breadcrumb -->
     <!-- BEGIN: Search -->
     <div class="intro-x relative mr-3 sm:mr-6">
         <div class="search hidden sm:block">
             <input type="text" class="search__input form-control border-transparent placeholder-theme-13" placeholder="Buscar...">
             <i data-feather="search" class="search__icon dark:text-gray-300"></i>
         </div>

     </div>
     <!-- END: Search -->
     <!-- BEGIN: Notifications -->
     <div class="intro-x dropdown mr-auto sm:mr-6">
         <div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button" aria-expanded="false"> <i data-feather="bell" class="notification__icon dark:text-gray-300"></i> </div>
         <div class="notification-content pt-2 dropdown-menu">
             <div class="notification-content__box dropdown-menu__content box dark:bg-dark-6">
                 <div class="notification-content__title">Notificaciones</div>
                 <div class="cursor-pointer relative flex items-center ">
                     <div class="w-12 h-12 flex-none image-fit mr-1">
                         <img alt="Tinker Tailwind HTML Admin Template" class="rounded-full" src="dist/images/profile-13.jpg">
                         <div class="w-3 h-3 bg-theme-20 absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                     </div>
                     <div class="ml-2 overflow-hidden">
                         <div class="flex items-center">
                             <a href="javascript:;" class="font-medium truncate mr-5">Venta web</a>
                             <div class="text-xs text-gray-500 ml-auto whitespace-nowrap">06:05 AM</div>
                         </div>
                         <div class="w-full truncate text-gray-600 mt-0.5">Folio:25, Total: $250, Items:5</div>
                     </div>
                 </div>

             </div>
         </div>
     </div>
     <!-- END: Notifications -->
     <!-- BEGIN: Account Menu -->
     <div class="intro-x dropdown w-8 h-8">
         <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false">
             <img alt="Tinker Tailwind HTML Admin Template" src="{{ asset('dist/images/logo.png') }}">
         </div>
         <div class="dropdown-menu w-56">
             <div class="dropdown-menu__content box dark:bg-dark-6">
                 <div class="p-4 border-b border-black border-opacity-5 dark:border-dark-3">
                     <div class="font-medium">@guest LuisFax @else {{ Auth()->user()->name }} @endguest</div>
                     <div class="text-xs text-gray-600 mt-0.5 dark:text-gray-600">Developer</div>
                 </div>
                 <div class="p-2">
                     <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-gray-200 dark:hover:bg-dark-3 rounded-md">
                         <i data-feather="user" class="w-4 h-4 mr-2"></i> Perfil
                     </a>
                 </div>
                 <div class="p-2 border-t border-black border-opacity-5 dark:border-dark-3">
                     <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit()" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-gray-200 dark:hover:bg-dark-3 rounded-md">
                         <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout
                     </a>
                     <form action="{{ route('logout') }}" method="post" id="logout-form">
                         @csrf
                     </form>
                 </div>
             </div>
         </div>
     </div>
     <!-- END: Account Menu -->
 </div>