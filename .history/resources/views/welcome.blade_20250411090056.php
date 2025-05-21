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
    <!-- Google Fonts: Manrope for modern elegance -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;400;600;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0a1e3d; /* Deep indigo for sophistication */
            --accent: #00d4ff; /* Cyan for vibrancy and tech appeal */
            --secondary: #e6f0fa; /* Light blue-gray for softness */
            --text-dark: #0f172a; /* Slate for crisp text */
            --text-light: #64748b; /* Muted gray for secondary text */
            --white: #ffffff;
            --glass-bg: rgba(255, 255, 255, 0.1); /* For glassmorphism */
            --shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            --backdrop-blur: blur(10px);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Manrope', sans-serif;
            background: linear-gradient(180deg, var(--secondary) 0%, var(--white) 100%);
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Header */
        header {
            position: sticky;
            top: 0;
            z-index: 1100;
            background: var(--glass-bg);
            backdrop-filter: var(--backdrop-blur);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .navbar {
            padding: 1.2rem 0;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--primary);
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: var(--accent);
        }

        .nav-link {
            font-size: 1rem;
            font-weight: 400;
            color: var(--text-dark);
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -4px;
            left: 0;
            background-color: var(--accent);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: var(--accent);
        }

        .dropdown-menu {
            background: var(--glass-bg);
            backdrop-filter: var(--backdrop-blur);
            border: none;
            border-radius: 12px;
            box-shadow: var(--shadow);
        }

        .dropdown-item {
            color: var(--text-dark);
            transition: background 0.3s ease;
        }

        .dropdown-item:hover {
            background: rgba(0, 212, 255, 0.1);
        }

        /* Hero Section */
        .hero {
            position: relative;
            min-height: 90vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, var(--primary) 0%, #1e3a8a 100%);
            color: var(--white);
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
            z-index: 1;
        }

        .hero .container {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 1s ease-out;
        }

        .hero p {
            font-size: 1.3rem;
            font-weight: 300;
            max-width: 600px;
            margin-bottom: 2rem;
            animation: fadeInUp 1.2s ease-out;
        }

        .btn-hero {
            background: var(--accent);
            color: var(--white);
            font-weight: 600;
            font-size: 1.1rem;
            padding: 14px 32px;
            border-radius: 50px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 212, 255, 0.4);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            animation: fadeInUp 1.4s ease-out;
        }

        .btn-hero:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 212, 255, 0.6);
            background: #00b7e6;
        }

        /* Carousel */
        .carousel-container {
            max-width: 700px;
            margin: 2rem auto;
        }

        .carousel-item img {
            border-radius: 16px;
            height: 400px;
            object-fit: cover;
            filter: brightness(0.95);
            transition: transform 0.5s ease, filter 0.5s ease;
        }

        .carousel-item.active img {
            transform: scale(1.02);
            filter: brightness(1);
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 8%;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 16px;
            transition: background 0.3s ease;
        }

        .carousel-control-prev:hover,
        .carousel-control-next:hover {
            background: rgba(0, 0, 0, 0.4);
        }

        /* Chat Button */
        .chat-button {
            position: fixed;
            bottom: 40px;
            right: 40px;
            background: var(--glass-bg);
            backdrop-filter: var(--backdrop-blur);
            color: var(--white);
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease, background 0.3s ease;
            z-index: 100;
        }

        .chat-button:hover {
            background: var(--accent);
            transform: rotate(360deg) scale(1.15);
        }

        .chat-button i {
            font-size: 1.8rem;
        }

        /* Footer */
        footer {
            background: var(--primary);
            color: var(--white);
            padding: 2rem 0;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        footer p {
            font-size: 0.95rem;
            font-weight: 300;
            margin: 0;
        }

        footer a {
            color: var(--accent);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #4cc9f0;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Main Spacing */
        main {
            padding-top: 20px;
        }

        /* Responsiveness */
        @media (max-width: 992px) {
            .hero h1 {
                font-size: 3rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .carousel-item img {
                height: 300px;
            }
        }

        @media (max-width: 768px) {
            .hero {
                min-height: 80vh;
                text-align: center;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .carousel-container {
                max-width: 100%;
                padding: 0 1rem;
            }

            .carousel-item img {
                height: 250px;
            }

            .chat-button {
                bottom: 30px;
                right: 30px;
                width: 56px;
                height: 56px;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.5rem;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .btn-hero {
                padding: 12px 24px;
                font-size: 1rem;
            }

            .carousel-item img {
                height: 200px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <img src="{{ asset('images/logosena.png') }}" alt="Logotipo SST" style="width: 70px; height: 60px; object-fit: contain;">
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
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1>Transforma la Seguridad con SST SENA</h1>
                        <p>Una plataforma innovadora que convierte datos en estrategias para entornos laborales más seguros y productivos.</p>
                        <a href="{{ route('register') }}" class="btn btn-hero">Explorar Ahora</a>
                    </div>
                    <div class="col-lg-6 carousel-container">
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
            </div>
        </section>
    </main>

    <!-- Chat Button -->
    <div class="chat-button" aria-label="Abrir chat de soporte">
        <i class="bi bi-chat-dots"></i>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>© {{ date('Y') }} SST SENA. Todos los derechos reservados. | <a href="#">Política de Privacidad</a> | <a href="#">Términos de Servicio</a></p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>