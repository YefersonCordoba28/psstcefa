<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ active('images/Favicon2.png')}}" type="image/x-icon">
    <title>Seguridad y Salud en el Trabajo (SST)</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Estilo del tema -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
    <!-- Barras de desplazamiento superpuestas -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <style>
        /* Estilos personalizados */
        body {
            background-color: #f4f6f9; /* Fondo gris claro */
            font-family: 'Source Sans Pro', sans-serif;
        }
        .navbar {
            background-color: #28a745; /* Verde SST */
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important; /* Texto blanco */
        }
        .main-sidebar {
            background-color: #007bff; /* Azul profesional */
        }
        .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
            background-color: #0056b3; /* Azul más oscuro */
        }
        .nav-link {
            color: #ffffff !important; /* Texto blanco */
        }
        .nav-link:hover {
            background-color: #0056b3; /* Azul más oscuro al pasar el mouse */
        }
        .content-wrapper {
            background-color: #ffffff; /* Fondo blanco para el contenido */
            padding: 20px;
        }
        .footer {
            background-color: #343a40; /* Gris oscuro para el pie de página */
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
        }
    </style>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Enlaces de la barra de navegación izquierda -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <!-- Enlaces de la barra de navegación derecha -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->nombre }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Cerrar sesión') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <div class="sidebar">
            <!-- Menú de la barra lateral -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <br><br><br><br>
                    <!-- Unidades productivas -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-seedling"></i>
                            <p> Informes de eventos <i class="fas fa-angle-left right"></i> </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('eventos.create')}}" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Registrar el evento</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('eventos.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-clipboard-list"></i>
                                    <p>Listas</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Bodega Finca -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-warehouse"></i>
                            <p> Bodega Finca <i class="fas fa-angle-left right"></i> </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ asset('AdminLTE-3.2.0/pages/UI/general.html') }}" class="nav-link">
                                    <i class="nav-icon fas fa-box"></i>
                                    <p>Insumos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ asset('AdminLTE-3.2.0/pages/UI/icons.html') }}" class="nav-link">
                                    <i class="nav-icon fas fa-tools"></i>
                                    <p>Herramientas</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Roles Mayordomo -->
                    <li class="nav-item">
                        <a href="{{ asset('AdminLTE-3.2.0/pages/widgets.html') }}" class="nav-link">
                            <i class="fas fa-user"></i>
                            <p>Roles Mayordomo</p>
                        </a>
                    </li>
                    <!-- Análisis de Producción -->
                    <li class="nav-item">
                        <a href="{{ asset('AdminLTE-3.2.0/pages/widgets.html') }}" class="nav-link">
                            <i class="fas fa-chart-bar"></i>
                            <p>Análisis de Producción</p>
                        </a>
                    </li>
                    <!-- Referencias geográficas -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>Referencias geográficas</p>
                        </a>
                    </li>
                    <!-- Informes -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Informes<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ asset('AdminLTE-3.2.0/pages/tables/simple.html') }}" class="nav-link">
                                    <i class="nav-icon fas fa-tasks"></i>
                                    <p>Actividades</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ asset('AdminLTE-3.2.0/pages/tables/data.html') }}" class="nav-link">
                                    <i class="nav-icon fas fa-file-invoice-dollar"></i>
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
    <footer class="footer">
        <div class="container">
            <span>© 2023 Seguridad y Salud en el Trabajo (SST). Todos los derechos reservados.</span>
        </div>
    </footer>
    <!-- jQuery -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- Aplicación AdminLTE -->
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE para fines de demostración -->
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/demo.js') }}"></script>
</body>
</html>