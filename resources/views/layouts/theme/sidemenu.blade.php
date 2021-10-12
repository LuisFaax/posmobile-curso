<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4 mt-3">
        <img alt="Tinker Tailwind HTML Admin Template" class="w-8" src="{{ asset('dist/images/logo2.svg') }}">
        <span class="hidden xl:block text-white text-lg ml-3"> POSMOBILE<span class="font-medium"></span> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="dash" class="side-menu {{ (request()->is('measures')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-feather="pie-chart"></i> </div>
                <div class="side-menu__title">
                    Dashboard
                </div>
            </a>

        </li>

        <li>
            <a href="side-menu-dark-inbox.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="package"></i> </div>
                <div class="side-menu__title"> Medidas </div>
            </a>
        </li>
        <li>
            <a href="side-menu-dark-file-manager.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="layers"></i> </div>
                <div class="side-menu__title"> Categorias </div>
            </a>
        </li>
        <li>
            <a href="side-menu-dark-point-of-sale.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="shopping-cart"></i> </div>
                <div class="side-menu__title"> Ventas </div>
            </a>
        </li>
        <li>
            <a href="side-menu-dark-chat.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="shopping-bag"></i> </div>
                <div class="side-menu__title"> Productos </div>
            </a>
        </li>
        <li>
            <a href="side-menu-dark-post.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="dollar-sign"></i> </div>
                <div class="side-menu__title"> Pagos </div>
            </a>
        </li>

        <li class="side-nav__devider my-6"></li>
        <li>
            <a href="side-menu-dark-calendar.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                <div class="side-menu__title"> Clientes </div>
            </a>
        </li>
        <li>
            <a href="side-menu-dark-calendar.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="lock"></i> </div>
                <div class="side-menu__title"> Usuarios </div>
            </a>
        </li>
        <li>
            <a href="side-menu-dark-calendar.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                <div class="side-menu__title"> Empresa </div>
            </a>
        </li>



        <li class="side-nav__devider my-6"></li>
        <li>
            <a href="side-menu-dark-calendar.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="key"></i> </div>
                <div class="side-menu__title"> Roles </div>
            </a>
        </li>
        <li>
            <a href="side-menu-dark-calendar.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="list"></i> </div>
                <div class="side-menu__title"> Permisos </div>
            </a>
        </li>
        <li>
            <a href="side-menu-dark-calendar.html" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="user-check"></i> </div>
                <div class="side-menu__title"> Asignar </div>
            </a>
        </li>

        <li class="side-nav__devider my-6"></li>
        <li>
            <a href="javascript:;" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="trello"></i> </div>
                <div class="side-menu__title">
                    Reportes
                    <div class="side-menu__sub-icon "> <i data-feather="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="">
                <li>
                    <a href="side-menu-dark-profile-overview-1.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="calendar"></i> </div>
                        <div class="side-menu__title"> Ventas por Fecha </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-dark-profile-overview-2.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="clipboard"></i> </div>
                        <div class="side-menu__title"> Cuentas por Cobrar </div>
                    </a>
                </li>
                <li>
                    <a href="side-menu-dark-profile-overview-3.html" class="side-menu">
                        <div class="side-menu__icon"> <i data-feather="bar-chart-2"></i> </div>
                        <div class="side-menu__title"> Estadísticos </div>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>