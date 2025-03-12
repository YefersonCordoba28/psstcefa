<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/Favicon2.png')}}" type="image/x-icon">
    <title>Bienvenido</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
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
        }
        .main-header {
            background-color: #003366;
            color: #fff;
        }
        .main-sidebar {
            background-color: #ffd700;
        }
        .nav-sidebar .nav-link.active {
            background-color: #003366;
            color: #fff;
        }
        .nav-sidebar .nav-link {
            color: #003366;
        }
        .nav-sidebar .nav-link:hover {
            background-color: #003366;
            color: #fff;
        }
        .content-wrapper {
            background-color: #ffffff;
        }
        .control-sidebar {
            background-color: #003366;
            color: #fff;
        }
    </style>
</head>

<body>
    <nav class="main-header navbar navbar-expand">
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
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Cerrar Sesión') }}
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
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <br><br><br><br>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="fas fa-seedling"></i>
                            <p> Reportes de Eventos <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('eventos.create')}}" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>Registre el evento</p>
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
                    <li class="nav-item">
                        <a href="{{ asset('AdminLTE-3.2.0/pages/widgets.html') }}" class="nav-link">
                            <i class="fas fa-user"></i>
                            <p>Roles Mayordomo</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ asset('AdminLTE-3.2.0/pages/widgets.html') }}" class="nav-link">
                            <i class="fas fa-chart-bar"></i>
                            <p>Análisis de Producción</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-globe"></i>
                            <p>Geo Referencias</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Reportes<i class="fas fa-angle-left right"></i></p>
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

    <aside class="control-sidebar control-sidebar-dark"></aside>

    <!-- Scripts -->
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{ asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('AdminLTE-3.2.0/dist/js/demo.js') }}"></script>
</body>

</html>
