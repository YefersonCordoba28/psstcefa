<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ active('images/Favicon2.png')}}" type="image/x-icon">
    <title>Seguridad y Salud en el Trabajo (SST)</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa; /* Fondo gris claro */
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background-color: #28a745; /* Verde SST */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important; /* Texto blanco */
        }
        .sidebar {
            background-color: #007bff; /* Azul profesional */
            min-height: 100vh;
            box-shadow: 2px 0 4px rgba(0, 0, 0, 0.1);
        }
        .sidebar .nav-link {
            color: #ffffff !important; /* Texto blanco */
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 5px;
        }
        .sidebar .nav-link:hover {
            background-color: #0056b3; /* Azul más oscuro al pasar el mouse */
        }
        .sidebar .nav-link.active {
            background-color: #0056b3; /* Azul más oscuro para el enlace activo */
        }
        .content {
            background-color: #ffffff; /* Fondo blanco para el contenido */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .footer {
            background-color: #343a40; /* Gris oscuro para el pie de página */
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }
    </style>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-shield-alt"></i> SST Colombia
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i> {{ Auth::user()->nombre }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                            </a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenedor principal -->
    <div class="container-fluid">
        <div class="row">
            <!-- Barra lateral -->
            <div class="col-md-3 col-lg-2 sidebar">
                <nav class="nav flex-column mt-4">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-home"></i> Inicio
                    </a>
                    <a href="{{ route('eventos.create')}}" class="nav-link">
                        <i class="fas fa-edit"></i> Registrar evento
                    </a>
                    <a href="{{ route('eventos.index')}}" class="nav-link">
                        <i class="fas fa-clipboard-list"></i> Listas
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-warehouse"></i> Bodega Finca
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-user"></i> Roles Mayordomo
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-bar"></i> Análisis de Producción
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-globe"></i> Referencias geográficas
                    </a>
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-alt"></i> Informes
                    </a>
                </nav>
            </div>

            <!-- Contenido principal -->
            <div class="col-md-9 col-lg-10 ms-sm-auto px-4">
                <div class="content mt-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Pie de página -->
    <footer class="footer">
        <div class="container">
            <span>© 2023 Seguridad y Salud en el Trabajo (SST). Todos los derechos reservados.</span>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>