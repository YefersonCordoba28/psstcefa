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

        .main-header {
            background-color: #3c8dbc !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-bottom: none;
            z-index: 1030;
        }

        .main-header .nav-link {
            color: #fff !important;
        }

        .main-header .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        .main-sidebar,
        .content-wrapper {
            background-color: #ffffff;
        }

        .main-sidebar {
            border-right: 1px solid #dee2e6;
            padding-top: 56px;
            position: fixed;
            top: 56px;
            bottom: 0;
            left: 0;
            width: 250px;
            overflow-y: auto;
        }

        .content-wrapper {
            margin-top: 56px;
            margin-left: 250px;
            padding: 20px;
        }

        .nav-link {
            color: rgb(10, 70, 134);
        }

        .nav-link.active {
            background-color: #cce5ff;
            color: #004085;
        }

        .nav-icon {
            color: #004085;
        }

        .sidebar-success-green {
            background-color: rgb(252, 252, 252);
        }

        .dropdown-menu-end {
            background-color: #b8daff;
        }
    </style>
</head>

<body>

    <!-- NAVBAR SUPERIOR -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
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

    <!-- SIDEBAR IZQUIERDA -->
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
                                <a href="{{ route('accidentes.create')}}" class="nav-link">
                                    <i class="fas fa-user-injured nav-icon"></i>
                                    <p>Registrar Accidente</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('accidentes.index')}}" class="nav-link">
                                    <i class="fas fa-calendar-check nav-icon"></i>
                                    <p>Lista Accidentes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-exclamation-triangle nav-icon"></i>
                                    <p>Registrar Incidente</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-ambulance nav-icon"></i>
                                    <p>Registrar Emergencia</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-hard-hat nav-icon"></i>
                                    <p>Registrar Inseguridad</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-clipboard-list nav-icon"></i>
                                    <p>Lista de Eventos</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-lock"></i>
                            <p>Roles de Seguridad</p>
                        </a>
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
                            <p>Reportes<i class="fas fa-angle-left right"></i></p>
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

    <!-- CONTENIDO PRINCIPAL -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    <aside class="control-sidebar control-sidebar-dark"></aside>

    <!-- Scripts -->
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
