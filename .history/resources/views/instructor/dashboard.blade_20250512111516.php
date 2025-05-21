<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Forzar HTTPS en los recursos -->
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/Favicon2.png') }}?v=1" type="image/x-icon">
    <title>Bienvenido</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}?v=1">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/dist/css/adminlte.min.css') }}?v=1">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}?v=1">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}?v=1" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f0f8ff;
            color: #333;
        }
        .main-header,
        .main-sidebar,
        .content-wrapper {
            background-color: #ffffff;
        }
        .content-wrapper {
            padding-top: 56px; /* Evita superposición con navbar fija */
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
        /* Ajustes para móviles */
        @media (max-width: 767.98px) {
            .main-sidebar {
                width: 250px;
            }
            .content-wrapper {
                margin-left: 0;
            }
        }
    </style>

    <!-- Script de depuración para verificar carga de recursos -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const resources = [
                '{{ asset('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}',
                '{{ asset('AdminLTE-3.2.0/dist/css/adminlte.min.css') }}',
                '{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}',
                '{{ asset('js/app.js') }}',
                '{{ asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}',
                '{{ asset('AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js') }}',
                '{{ asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}',
                '{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}',
                '{{ asset('AdminLTE-3.2.0/dist/js/adminlte.js') }}',
                '{{ asset('AdminLTE-3.2.0/dist/js/demo.js') }}'
            ];

            resources.forEach(resource => {
                fetch(resource + '?v=1')
                    .then(response => {
                        if (!response.ok) {
                            console.error(`Error al cargar: ${resource} (Estado: ${response.status})`);
                            alert(`Error al cargar el recurso: ${resource}. Verifica que el archivo exista en public/.`);
                        }
                    })
                    .catch(error => {
                        console.error(`Error al cargar: ${resource}`, error);
                        alert(`Error al cargar el recurso: ${resource}. Verifica la conexión o la configuración del servidor.`);
                    });
            });
        });
    </script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name ?? 'Usuario' }}
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
<aside class="main-sidebar sidebar-success-green elevation-4">
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Reportes de SST -->
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-shield-alt"></i>
                        <p>
                            Reportes de SST
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview pl-3">

                        <!-- Accidentes -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fas fa-user-injured nav-icon"></i>
                                <p>
                                    Accidentes
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-4">
                                <li class="nav-item">
                                    <a href="{{ route('accidentes.create') }}" class="nav-link">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Registrar Accidente</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('accidentes.index') }}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Lista Accidentes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('personas_involucradas.index') }}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Personas Involucradas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Incidentes -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fas fa-exclamation-triangle nav-icon"></i>
                                <p>
                                    Incidentes
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-4">
                                <li class="nav-item">
                                    <a href="{{ route('incidentes.create') }}" class="nav-link">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Registrar Incidente</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('incidentes.index') }}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Lista Incidentes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Emergencias -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fas fa-ambulance nav-icon"></i>
                                <p>
                                    Emergencias
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-4">
                                <li class="nav-item">
                                    <a href="{{ route('emergencias.create') }}" class="nav-link">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Registrar Emergencia</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('emergencias.index') }}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Lista Emergencias</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Actos Inseguros -->
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="fas fa-hard-hat nav-icon"></i>
                                <p>
                                    Actos Inseguros
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview pl-4">
                                <li class="nav-item">
                                    <a href="{{ route('actos_inseguros.create') }}" class="nav-link">
                                        <i class="fas fa-plus nav-icon"></i>
                                        <p>Registrar Inseguridad</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('actos_inseguros.index') }}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>Lista Inseguridades</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Lista general de eventos -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-clipboard-list nav-icon"></i>
                                <p>Lista General de Eventos</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <!-- Análisis de Riesgos -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Análisis de Riesgos</p>
                    </a>
                </li>

                <!-- Geo Referencias -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p>Geo Referencias</p>
                    </a>
                </li>

                <!-- Reportes adicionales -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-contract"></i>
                        <p>
                            Reportes
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview pl-3">
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



    <!-- Contenido principal -->
    <div class="content-wrapper">
        @yield('content')
    </div>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark"></aside>

    <!-- Scripts -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}?v=1"></script>
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js') }}?v=1"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="{{ asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}?v=1"></script>
    <script src="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}?v=1"></script>
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/adminlte.js') }}?v=1"></script>
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/demo.js') }}?v=1"></script>
</body>
</html>