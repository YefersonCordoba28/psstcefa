<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión SST</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #003087; /* Deep navy for trust and professionalism */
            --accent: #00a3e0; /* Bright blue for approachability */
            --background: #f5f7fa; /* Soft gray-blue for calm backgrounds */
            --text: #1a202c; /* Dark gray for readability */
            --white: #ffffff;
            --shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background);
            margin: 0;
            padding: 0;
            color: var(--text);
            line-height: 1.6;
        }

        /* Header */
        header {
            background: var(--white);
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            padding: 1rem 0;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary);
        }

        .nav-link {
            font-size: 1rem;
            color: var(--text);
            transition: color 0.2s ease;
        }

        .nav-link:hover {
            color: var(--accent);
        }

        .dropdown-menu {
            border: none;
            box-shadow: var(--shadow);
            border-radius: 8px;
        }

        /* Hero Section */
        .hero {
            background-color: var(--white);
            padding: 80px 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.1rem;
            color: var(--text);
            max-width: 600px;
            margin: 0 auto 1.5rem;
        }

        .btn-hero {
            background-color: var(--accent);
            color: var(--white);
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-hero:hover {
            background-color: #008bbf;
            transform: translateY(-2px);
        }

        /* Carousel */
        .carousel-container {
            max-width: 600px;
            margin: 2rem auto;
        }

        .carousel-item img {
            border-radius: 12px;
            height: 300px;
            object-fit: cover;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 10%;
            opacity: 0.7;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            opacity: 1;
        }

        /* Chat Button */
        .chat-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: var(--accent);
            color: var(--white);
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow);
            transition: background-color 0.3s ease, transform 0.3s ease;
            z-index: 99;
        }

        .chat-button:hover {
            background-color: var(--primary);
            transform: scale(1.1);
        }

        /* Footer */
        footer {
            background-color: var(--primary);
            color: var(--white);
            padding: 1.5rem 0;
            text-align: center;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }

        footer a {
            color: var(--accent);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        footer a:hover {
            color: #4cc9f0;
        }

        /* Spacing */
        main {
            padding-top: 20px;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
                padding: 0 1rem;
            }

            .carousel-item img {
                height: 200px;
            }
        }

        @media (max-width: 576px) {
            .hero {
                padding: 60px 0;
            }

            .navbar-brand {
                font-size: 1.25rem;
            }

            .chat-button {
                bottom: 20px;
                right: 20px;
                width: 48px;
                height: 48px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container">
                <img src="{{ asset('images/logosena.png') }}" alt="Logotipo SST" style="width: 60px; height: 50px; object-fit: contain;">
                <a class="navbar-brand" href="{{ url('/') }}">SST SENA</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Cerrar Sesión
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <main>
        <section class="hero">
            <div class="container">
                <h1>Seguridad y Salud con SST SENA</h1>
                <p>Un sistema innovador para gestionar la seguridad en el trabajo, proteger vidas y construir entornos laborales más seguros.</p>
                <a href="{{ route('register') }}" class="btn btn-hero">Comenzar Ahora</a>
                <div class="carousel-container">
                    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/carrusel1.jpg') }}" class="d-block w-100" alt="Entorno laboral seguro">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/carrusel2.jpg') }}" class="d-block w-100" alt="Equipo con EPI">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Chat Button -->
    <div class="chat-button" aria-label="Abrir chat de soporte">
        <i class="bi bi-chat-dots fs-4"></i>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>© {{ date('Y') }} SST SENA. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>