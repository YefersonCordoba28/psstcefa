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
    <aside class="main-sidebar sidebar-success-green elevation-4">
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Menú principal de SST -->
                <li class="nav-item has-treeview menu-open">
                    <a href="" class="nav-link active">
                        <i class="nav-icon fas fa-shield-alt"></i>
                        <p>
                            Reportes de SST
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <!-- Registro de Tipos (Agrupado) -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>
                                Registro de Tipos
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview pl-3">

                            <!-- Tipos de Accidentes -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>Tipos de Accidentes <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview pl-3">
                                    <li class="nav-item">
                                        <a href="{{ route('tipo_accidentes.create') }}" class="nav-link">
                                            <i class="fas fa-plus nav-icon"></i><p>Registrar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('tipo_accidentes.index') }}" class="nav-link">
                                            <i class="fas fa-list nav-icon"></i><p>Listado</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Tipos de Lesiones -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user-injured"></i>
                                    <p>Tipos de Lesiones <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview pl-3">
                                    <li class="nav-item">
                                        <a href="{{ route('tipo_lesiones.create') }}" class="nav-link">
                                            <i class="fas fa-plus nav-icon"></i><p>Registrar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('tipo_lesiones.index') }}" class="nav-link">
                                            <i class="fas fa-list nav-icon"></i><p>Listado</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Tipos de Riesgos -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-exclamation-triangle"></i>
                                    <p>Tipos de Riesgos <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview pl-3">
                                    <li class="nav-item">
                                        <a href="{{ route('tipo_riesgos.create') }}" class="nav-link">
                                            <i class="fas fa-plus nav-icon"></i><p>Registrar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('tipo_riesgo.index') }}" class="nav-link">
                                            <i class="fas fa-list nav-icon"></i><p>Listado</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Tipos de incidentes -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-exclamation-triangle"></i>
                                    <p>Tipos de Incidentes <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview pl-3">
                                    <li class="nav-item">
                                        <a href="{{ route('tipo_incidentes.create') }}" class="nav-link">
                                            <i class="fas fa-plus nav-icon"></i><p>Registrar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('tipo_incidentes.index') }}" class="nav-link">
                                            <i class="fas fa-list nav-icon"></i><p>Listado</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                             <!-- Tipos de Emergenias -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-exclamation-triangle"></i>
                                    <p>Tipos de Emergencias <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview pl-3">
                                    <li class="nav-item">
                                        <a href="{{ route('tipo_emergencias.create') }}" class="nav-link">
                                            <i class="fas fa-plus nav-icon"></i><p>Registrar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('tipo_emergencias.index') }}" class="nav-link">
                                            <i class="fas fa-list nav-icon"></i><p>Listado</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <!-- Cargos -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user-tag"></i>
                                    <p>Cargos <i class="fas fa-angle-left right"></i></p>
                                </a>
                                <ul class="nav nav-treeview pl-3">
                                    <li class="nav-item">
                                        <a href="{{ route('cargos.create') }}" class="nav-link">
                                            <i class="fas fa-plus nav-icon"></i><p>Registrar</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-list nav-icon"></i><p>Listado</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </li>

                    <!-- Ítems simples -->
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

                    <!-- Submenú: Reportes -->
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
                                    <p>Reporte de Actividades</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="fas fa-calculator nav-icon"></i>
                                    <p>Reporte Contable</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                </li>
            </ul>
        </nav>
    </div>
</aside>


    <!-- Contenido principal -->
    <div class="content-wrapper">
    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Seguridad y Salud Laboral</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #f0f9ff 0%, #e6f3fe 50%, #d8edff 100%);
        }
        .card-shadow {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800">
    <!-- Contenedor principal -->
    <div class="min-h-screen hero-gradient flex items-center justify-center px-4 py-12">
        <!-- Tarjeta principal -->
        <div class="w-full max-w-6xl mx-auto">
            <div class="bg-white rounded-xl card-shadow overflow-hidden">
                <!-- Layout de dos columnas -->
                <div class="flex flex-col lg:flex-row">
                    <!-- Columna izquierda - Contenido -->
                    <div class="w-full lg:w-1/2 p-12 flex flex-col justify-center">
                        <div class="mb-2">
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full uppercase font-semibold tracking-wide">Versión 3.2</span>
                        </div>
                        <div class="mb-8">
                            <h1 class="text-4xl font-bold text-gray-900 leading-tight mb-4">Bienvenido al Sistema Integral de Seguridad Laboral</h1>
                            <p class="text-lg text-gray-600">Plataforma certificada para la gestión de riesgos profesionales y promoción de la salud en el ámbito laboral.</p>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <svg class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-gray-700">Cumplimiento normativo automatizado</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <svg class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-gray-700">Gestión centralizada de incidentes</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <svg class="h-5 w-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-gray-700">Reportes analíticos en tiempo real</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-10 flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                            <div>
                                <button class="w-full sm:w-auto px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Acceder al Sistema
                                </button>
                            </div>
                            <div>
                                <button class="w-full sm:w-auto px-6 py-3 border border-gray-300 hover:border-gray-400 text-gray-700 font-medium rounded-lg transition duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                                    Solicitar Demostración
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Columna derecha - Imagen -->
                    <div class="w-full lg:w-1/2 bg-gray-50 flex items-center justify-center p-8">
                        <div class="relative w-full h-96">
                            <div class="absolute inset-0 bg-blue-500 rounded-lg opacity-10"></div>
                            <div class="absolute inset-0 flex items-center justify-center p-8">
                                <img src="https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Seguridad laboral" class="rounded-lg object-cover w-full h-full">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Nota legal -->
            <div class="mt-6 text-center">
                <p class="text-xs text-gray-500">Sistema certificado bajo la norma ISO 45001:2018. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</body>
</html>
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