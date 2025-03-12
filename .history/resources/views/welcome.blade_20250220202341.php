<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Bienvenida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #002060;
        }
        .navbar-nav .nav-link {
            color: white;
            font-weight: bold;
        }
        .navbar-nav .nav-link:hover {
            color: #00aaff;
        }
        .header {
            background-color: #002060;
            color: white;
            padding: 40px 0;
            text-align: center;
        }
        .main-content {
            padding: 50px 20px;
            text-align: center;
        }
        .main-content h1 {
            font-size: 2.5rem;
            color: #002060;
        }
        .btn-custom {
            background-color: #002060;
            color: white;
            font-weight: bold;
            border-radius: 25px;
            padding: 10px 30px;
        }
        .btn-custom:hover {
            background-color: #00aaff;
            color: white;
        }
        footer {
            background-color: #002060;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Mi Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

        </div>
    </nav>

    <header class="header">
        <h1>Bienvenido a Mi Portal</h1>
        <p>Impulsando la formación y el crecimiento profesional</p>
    </header>

    <section id="inicio" class="main-content">
        <h1>Inicio</h1>
        <p>Explora nuestros cursos y oportunidades de formación.</p>
        <a href="#registro" class="btn btn-custom">Regístrate Ahora</a>
    </section>

    <section id="registro" class="main-content">
        <h1>Registro</h1>
        <p>Completa el formulario para unirte a nuestra plataforma.</p>
        <a href="#" class="btn btn-custom">Ir al Formulario de Registro</a>
    </section>

    <footer>
        <p>&copy; 2024 Mi Portal. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

