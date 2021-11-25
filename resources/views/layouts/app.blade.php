<!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>
        <div id="app">
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
               <!-- Navbar Brand-->
               <a class="navbar-brand ps-3" href="#">Maquina de Turing</a>
               <!-- Sidebar Toggle-->
               {{--  <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button> --}}
               <!-- Navbar-->
               <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-bars"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{route('turing.presentacion')}}"><i class="fas fa-play"></i> Inicio</a></li>
                        <li><a class="dropdown-item" href="{{route('turing.configuracion')}}"><i class="fas fa-cogs"></i> Configuración</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <main class="py-4">
            @yield('content')
            <footer class="page-footer font-small blue">

              <!-- author: Karen Apablaza -->
              <div class="footer-copyright text-center py-3">© 2021 UNPSJB:
                <a href="#"> Fundamentos Teoricos de la Informatica</a>
            </div>
            <!-- author: Karen Apablaza -->

        </footer>


    </main>
</div>

</body>
</html>
