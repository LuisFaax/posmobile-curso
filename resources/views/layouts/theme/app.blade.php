<!DOCTYPE html>

<html lang="es" class="dark">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <link href="{{ asset('dist/images/logo.svg') }}" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistema de ventas posmobile, ventas en ruta, ventas web,curso laravel livewire">
    <meta name="keywords" content="sistema,ventas,mobile,clientes,pagos,web,luis,fax,curso">
    <meta name="author" content="LUISFAX">
    <title>Sistema de Ventas POSMOBILE</title>
    <!-- BEGIN: CSS Assets-->
    @include('layouts.theme.styles')
    @livewireStyles
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

<body class="main">
    <!-- BEGIN: Mobile Menu -->
    @include('layouts.theme.mobilemenu')
    <!-- END: Mobile Menu -->
    <div class="flex overflow-hidden">
        <!-- BEGIN: Side Menu -->
        @include('layouts.theme.sidemenu')
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        @include('layouts.theme.content')
        <!-- END: Content -->
    </div>
    <!-- BEGIN: Dark Mode Switcher-->
    @include('layouts.theme.switcher')
    <!-- END: Dark Mode Switcher-->
    <!-- BEGIN: JS Assets-->
    @include('layouts.theme.scripts')
    @livewireScripts
    <!-- END: JS Assets-->
</body>

</html>