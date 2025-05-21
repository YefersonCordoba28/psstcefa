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
    <!-- Font: Arial (matches OIT's sans-serif) -->
    <style>
        :root {
            --primary: #003087; /* Deep blue from OIT header */
            --secondary: #2e1a47; /* Dark purple for hero overlay */
            --text-light: #ffffff; /* White for text */
            --text-muted: #b0b0b0; /* Light gray for secondary text */
            --bg-light: #f5f5f5; /* Light gray background */
            --shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-light);
            line-height: 1.6;
        }

        /* Header */
        header {
            background-color: var(--primary);
            color: var(--text-light);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            padding: 0.5rem 1rem;
        }

        .navbar-brand img {
            width: 120px;
            height: auto;
        }

        .navbar-nav .nav-link {
            color: var(--text-light);
            font-size: 1rem;
            font-weight: 400;
            padding: 0.5rem 1rem;
            transition: background-color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .navbar-nav .dropdown-menu {
            background-color: var(--primary);
            border: none;
        }

        .navbar-nav .dropdown-item {
            color: var(--text-light);
        }

        .navbar-nav .dropdown-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .search-icon {
            color: var(--text-light);
            font-size: 1.2rem;
            margin-left: 1rem;
        }

        /* Breadcrumb */
        .breadcrumb-section {
            background-color: #fff;
            padding: 0.5rem 0;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0.5rem 1rem;
            margin-bottom: 0;
        }

        .breadcrumb-item a {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.9rem;
        }

        .breadcrumb-item a:hover {
            color: var(--text-light);
        }

        .breadcrumb-item.active {
            color: #000;
            font-size: 0.9rem;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: "\203A"; /* Right arrow */
            color: var(--text-muted);
        }

        /* Hero Section */
        .hero {
            position: relative;
            min-height: 80vh;
            background: url('{{ asset('images/hero-office.jpg') }}') no-repeat center center/cover;
            color: var(--text-light);
            display: flex;
            align-items: flex-end;
            padding: 2rem;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, var(--secondary) 30%, transparent 70%);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 500px;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        /* Social Media Icons */
        .social-icons {
            margin-top: 1rem;
        }

        .social-icons a {
            color: var(--text-light);
            font-size: 1.5rem;
            margin-right: 1rem;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--text-muted);
        }

        /* Carousel (Hidden to match OIT design) */
        .carousel-container {
            display: none;
        }

        /* Chat Button */
        .chat-button {
            position: fixed;
            bottom: 40px;
            right: 40px;
            background-color: var(--primary);
            color: var(--text-light);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow);
            transition: background-color 0.3s ease, transform 0.3s ease;
            z-index: 100;
        }

        .chat-button:hover {
            background-color: var(--secondary);
            transform: scale(1.1);
        }

        .chat-button i {
            font-size: 1.5rem;
        }

        /* Footer */
        footer {
            background-color: var(--primary);
            color: var(--text-light);
            padding: 1.5rem 0;
            text-align: center;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }

        footer a {
            color: var(--text-light);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: var(--text-muted);
        }

        /* Main Spacing */
        main {
            padding-top: 0;
        }

        /* Responsiveness */
        @media (max-width: 992px) {
            .hero h1 {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .hero {
                min-height: 60vh;
                text-align: center;
                align-items: center;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .hero-content {
                max-width: 100%;
            }

            .social-icons {
                text-align: center;
            }

            .chat-button {
                bottom: 30px;
                right: 30px;
                width: 50px;
                height: 50px;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand img {
                width: 100px;
            }

            .hero h1 {
                font-size: 1.5rem;
            }

            .breadcrumb-item a,
            .breadcrumb-item.active {
                font-size: 0.8rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-md navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logosena.png') }}" alt="Logotipo SST">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Acerca</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Temas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Países</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Investigación</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Datos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Normas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Colaboraciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Más</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="authDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="display: none;">
                                {{ Auth::user()->name ?? '' }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="authDropdown">
                                @guest
                                    @if (Route::has('login'))
                                        <li><a class="dropdown-item" href="{{ route('login') }}">Iniciar Sesión</a></li>
                                    @endif
                                    @if (Route::has('register'))
                                        <li><a class="dropdown-item" href="{{ route('register') }}">Registrarse</a></li>
                                    @endif
                                @else
                                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Cerrar Sesión
                                        </a></li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                @endguest
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link search-icon" href="#"><i class="bi bi-search"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Breadcrumb -->
    <div class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house-door"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Temas y sectores</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <main>
        <section class="hero">
            <div class="hero-content">
                <h1>Seguridad y Salud en el Trabajo</h1>
                <div class="social-icons">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
            <!-- Carousel (Hidden to match OIT design) -->
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
        </section>
    </main>

    <!-- Chat Button -->
    <div class="chat-button" aria-label="Abrir chat de soporte">
        <i class="bi bi-chat-dots"></i>
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