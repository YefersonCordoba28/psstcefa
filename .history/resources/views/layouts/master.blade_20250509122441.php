<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Forzar HTTPS en los recursos -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}" type="image/x-icon">
    <title>Bienvenido</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/dist/css/adminlte.min.css">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

    <!-- Scripts -->
    <script src="/js/app.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-...hash..." crossorigin="anonymous" referrerpolicy="no-referrer" />

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
            color: rgb(10, 70, 134);
        }
        .nav-link.active {
            background-color: #cce5ff;
            color: #004085;
        }
        .nav-icon {
            color: #004085;
        }
        .navbar-white {
            background-color: rgb(94, 113, 133);
        }
        .sidebar-success-green {
            background-color: rgb(252, 252, 252);
        }
        .dropdown-menu-end {
            background-color: #b8daff;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Barra de navegación superior -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ auth()->user()->name ?? 'Usuario' }}
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

    <!-- Sidebar -->
    <!-- Sidebar -->
<aside class="main-sidebar sidebar-success-green elevation-4">
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Informes de SST -->
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active bg-primary text-white">
                        <i class="nav-icon fas fa-shield-alt"></i>
                        <p>
                            Informes de SST
                            <i class="right fas fa-angle-down"></i>
                        </p>
                    </a>

                    <!-- Accidentes -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-user-injured"></i>
                            <p>
                                Accidentes
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('tipoaccidente.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tipo de Accidentes</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('tipolesion.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Tipo de Lesiones</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('parteafectada.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Partes Afectadas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('persona.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Personas Involucradas</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Incidentes -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-exclamation-triangle"></i>
                            <p>
                                Incidentes
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                    </li>

                    <!-- Emergencias -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-ambulance"></i>
                            <p>
                                Emergencias
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                    </li>

                    <!-- Actos Inseguros -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-hard-hat"></i>
                            <p>
                                Actos Inseguros
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                    </li>

                    <!-- Lista General de Eventos -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Lista General de Eventos</p>
                        </a>
                    </li>

                    <!-- Análisis de riesgos -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>Análisis de riesgos</p>
                        </a>
                    </li>

                    <!-- Referencias geográficas -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-map-marked-alt"></i>
                            <p>Referencias geográficas</p>
                        </a>
                    </li>

                    <!-- Informes -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>
                                Informes
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                    </li>

                </li>
            </ul>
        </nav>
    </div>
</aside>


    <!-- Contenido principal -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    <!-- Sidebar de control (opcional) -->
    <aside class="control-sidebar control-sidebar-dark"></aside>

    <!-- Scripts necesarios -->
    <script src="/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <script src="/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="/AdminLTE-3.2.0/dist/js/adminlte.js"></script>
    <script src="/AdminLTE-3.2.0/dist/js/demo.js"></script>
</body>
</html>