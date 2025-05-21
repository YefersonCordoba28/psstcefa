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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #1a3c5e; /* Deep blue for professionalism */
            --accent: #f7931e; /* Vibrant orange for energy */
            --secondary: #e0e7ff; /* Light blue for backgrounds */
            --text-dark: #1f2937; /* Dark gray for text */
            --text-light: #6b7280; /* Lighter gray for secondary text */
            --white: #ffffff;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--secondary);
            margin: 0;
            padding: 0;
            line-height: 1.6;
            color: var(--text-dark);
        }

        /* Header */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            background: var(--white);
            box-shadow: var(--shadow);
        }

        .navbar {
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--primary);
            font-size: 1.5rem;
        }

        .nav-link {
            color: var(--text-dark);
            font-weight: 400;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: var(--accent);
        }

        .dropdown-menu {
            border: none;
            box-shadow: var(--shadow);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, var(--primary) 0%, #2b5d8c 100%);
            color: var(--white);
            padding: 100px 0;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.25rem;
            font-weight: 300;
            margin-bottom: 2rem;
        }

        .btn-hero {
            background-color: var(--accent);
            color: var(--white);
            font-weight: 600;
            padding: 12px 30px;
            border-radius: 50px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-hero:hover {
            background-color: #ffaa4f;
            transform: translateY(-2px);
        }

        /* Carousel */
        .carousel-item img {
            border-radius: 12px;
            object-fit: cover;
            height: 400px;
            transition: transform 0.5s ease;
        }

        .carousel-item.active img {
            transform: scale(1.05);
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 12px;
        }

        /* Chat Button */
        .chat-button {
            position: fixed;
            bottom: 100px;
            right: 30px;
            background-color: var(--primary);
            color: var(--white);
            border-radius: 50%;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow);
            cursor: pointer;
            transition: transform 0.3s ease, background-color 0.3s ease;
            z-index: 99;
        }

        .chat-button:hover {
            background-color: var(--accent);
            transform: scale(1.1);
        }

        /* Footer */
        footer {
            background-color: var(--primary);
            color: var(--white);
            padding: 20px 0;
            text-align: center;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }

        footer a {
            color: var(--accent);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        footer a:hover {
            color: #ffaa4f;
        }

        /* Main Content Spacing */
        main {
            margin-top: 90px;
            margin-bottom: 80px;
        }

        /* Responsiveness */
        @media (max-width: 992px) {
            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            .carousel-item img {
                height: 300px;
            }
        }

        @media (max-width: 576px) {
            .hero {
                padding: 60px 0;
                text-align: center;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .carousel-item img {
                height: 200px;
            }

            .chat-button {
                width: 60px;
                height: 60px;
                bottom: 80px;
                right: 20px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container">
                <img src="{{ asset('images/logosena.png') }}" alt="Logotipo SST" style="width: 80px; height: 65px; object-fit: contain;">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Sistema de Gestión SST
                </a>
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
                    <div class="col-lg-6 text-center text-lg-start">
                        <h1>SST SENA</h1>
                        <p>
                            Impulsamos la seguridad y salud en el trabajo con soluciones innovadoras que transforman datos en estrategias para proteger vidas y optimizar entornos laborales.
                        </p>
                        <a href="{{ route('register') }}" class="btn btn-hero">Únete Ahora</a>
                    </div>
                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('images/carrusel1.jpg') }}" class="d-block w-100" alt="Trabajadores con EPI">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('images/carrusel2.jpg') }}" class="d-block w-100" alt="Seguridad en el trabajo">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Chat Button -->
    <div class="chat-button" aria-label="Abrir chat de soporte">
        <i class="bi bi-chat-dots fs-3"></i>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>© {{ date('Y') }} SST SENA. Todos los derechos reservados. | <a href="#">Política de Privacidad</a> | <a href="#">Términos de Uso</a></p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>