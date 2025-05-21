<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/Favicon2.png')}}" type="image/x-icon">
    <title>Bienvenido</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f0f8ff;
            color: #333;
        }
        .main-header, .main-sidebar, .content-wrapper {
            background-color: #ffffff;
        }
        .main-sidebar {
            border-right: 1px solid #dee2e6;
        }
        .nav-link {
            color:rgb(10, 70, 134);
        }
        .nav-link.active {
            background-color: #cce5ff;
            color: #004085;
        }
        .nav-icon {
            color: #004085;
        }
        .navbar-white {
            background-color:rgb(94, 113, 133);
        }
        .sidebar-success-green {
            background-color:rgb(252, 252, 252);
        }
        .dropdown-menu-end {
            background-color: #b8daff;
        }
    </style>
</head>

<body>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    //C:\laragon\www\Proyecto_SST_ - copia\
ErrorException
Attempt to read property "name" on null (View: C:\laragon\www\Proyecto_SST_ - copia\resources\views\layouts\master.blade.php)
http://127.0.0.1:8000/tipo_lesiones/create
Stack trace
Request
App
User
Context
Debug
Share 


Collapse vendor frames
64
C:\laragon\www\Proyecto_SST_ - copia\resources\views/layouts/master.blade.php
Illuminate\Foundation\Bootstrap\HandleExceptions
:63
63
:63
62
C:\laragon\www\Proyecto_SST_ - copia\vendor\laravel\framework\src\Illuminate\Filesystem\Filesystem.php
Illuminate\Filesystem\Filesystem
:107
61
Illuminate\Filesystem\Filesystem
:108
60
Illuminate\View\Engines\PhpEngine
:58
59
Illuminate\View\Engines\CompilerEngine
:61
58
Facade\Ignition\Views\Engines\CompilerEngine
:37
57
Illuminate\View\View
:139
56
Illuminate\View\View
:122
55
Illuminate\View\View
:91
54
:32
53
Illuminate\Filesystem\Filesystem
:107
52
Illuminate\Filesystem\Filesystem
:108
51
Illuminate\View\Engines\PhpEngine
:58
50
Illuminate\View\Engines\CompilerEngine
:61
49
Facade\Ignition\Views\Engines\CompilerEngine
:37
48
Illuminate\View\View
:139
47
Illuminate\View\View
:122
46
Illuminate\View\View
:91
45
Illuminate\Http\Response
:69
44
Illuminate\Http\Response
:35
43
Illuminate\Routing\Router
:820
42
Illuminate\Routing\Router
:789
41
Illuminate\Routing\Router
:721
40
Illuminate\Pipeline\Pipeline
:128
39
Illuminate\Routing\Middleware\SubstituteBindings
:50
38
Illuminate\Pipeline\Pipeline
:167
37
Illuminate\Foundation\Http\Middleware\VerifyCsrfToken
:78
36
Illuminate\Pipeline\Pipeline
:167
35
Illuminate\View\Middleware\ShareErrorsFromSession
:49
34
Illuminate\Pipeline\Pipeline
:167
33
Illuminate\Session\Middleware\StartSession
:121
32
Illuminate\Session\Middleware\StartSession
:64
31
Illuminate\Pipeline\Pipeline
:167
30
Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse
:37
29
Illuminate\Pipeline\Pipeline
:167
28
Illuminate\Cookie\Middleware\EncryptCookies
:67
27
Illuminate\Pipeline\Pipeline
:167
26
Illuminate\Pipeline\Pipeline
:103
25
Illuminate\Routing\Router
:723
24
Illuminate\Routing\Router
:698
23
Illuminate\Routing\Router
:662
22
Illuminate\Routing\Router
:651
21
Illuminate\Foundation\Http\Kernel
:167
20
Illuminate\Pipeline\Pipeline
:128
19
Illuminate\Foundation\Http\Middleware\TransformsRequest
:21
18
Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull
:31
17
Illuminate\Pipeline\Pipeline
:167
16
Illuminate\Foundation\Http\Middleware\TransformsRequest
:21
15
Illuminate\Foundation\Http\Middleware\TrimStrings
:40
14
Illuminate\Pipeline\Pipeline
:167
13
Illuminate\Foundation\Http\Middleware\ValidatePostSize
:27
12
Illuminate\Pipeline\Pipeline
:167
11
Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance
:86
10
Illuminate\Pipeline\Pipeline
:167
9
Fruitcake\Cors\HandleCors
:38
8
Illuminate\Pipeline\Pipeline
:167
7
Illuminate\Http\Middleware\TrustProxies
:39
6
Illuminate\Pipeline\Pipeline
:167
5
Illuminate\Pipeline\Pipeline
:103
4
Illuminate\Foundation\Http\Kernel
:142
3
Illuminate\Foundation\Http\Kernel
:111
2
:52
1
:21
Illuminate\Foundation\Bootstrap\HandleExceptions::handleError
C:\laragon\www\Proyecto_SST_ - copia\resources\views/layouts/master.blade.php:63































            background-color: #b8daff;

        }

    </style>

</head>


<body>

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">

        <ul class="navbar-nav">

            <li class="nav-item">

                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>

            </li>

        </ul>

        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">

                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                    {{ Auth::user()->name }}

                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                        {{ __('Cerrar Sesión') }}

                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">

                        @csrf

                    </form>

                </div>

            </li>

        </ul>

    </nav>


    <aside class="main-sidebar sidebar-success-green elevation-4">

        <div class="sidebar">


            
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Cerrar Sesión') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-success-green elevation-4">
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-shield-alt"></i>
                            <p>
                                Reportes de SST
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fas fa-calendar-check nav-icon"></i>
                                    <p>Registrar Evento</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="fas fa-clipboard-list nav-icon"></i>
                                    <p>Lista de Eventos</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-lock"></i>
                            <p>
                                Tipos de accidentes
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('tipo_accidentes.create') }}" class="nav-link">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>Registrar Tipos de Accidentes</p>
                                </a>
                            </li>
                            <li class="nav-item"> 
                                <a href="{{ route('tipo_accidentes.index') }}" class="nav-link">
                                    <i class="fas fa-chalkboard-teacher nav-icon"></i>
                                    <p>Lista </p>
                                </a>
                            </li>
                        </ul>

                        <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-lock"></i>
                            <p>
                                 Areas o unidades productivas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('area_unidad_productivas.create') }}" class="nav-link">
                                    <i class="fas fa-user-cog nav-icon"></i>
                                    <p>Registrar Tipos de Accidentes</p>
                                </a>
                            </li>
                            <li class="nav-item"> 
                                <a href="{{ route('tipo_accidentes.index') }}" class="nav-link">
                                    <i class="fas fa-chalkboard-teacher nav-icon"></i>
                                    <p>Lista </p>
                                </a>
                            </li>
                        </ul>

                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>Análisis de Riesgos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-map-marked-alt"></i>
                            <p>Geo Referencias</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-contract"></i>
                            <p>
                                Reportes
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-clipboard-check nav-icon"></i>
                                    <p>Actividades</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-calculator nav-icon"></i>
                                    <p>Contable</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        @yield('content')
    </div>

    <aside class="control-sidebar control-sidebar-dark"></aside>

    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="{{ asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/demo.js') }}"></script>
</body>

</html>