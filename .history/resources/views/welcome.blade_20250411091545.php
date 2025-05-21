<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Gestión SST</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        :root {
            --primary-dark: rgb(255, 255, 255);
            --primary-light: rgb(255, 255, 255);
            --accent: #f7931e;
            --bg-light: #f8f9fa;
            --hero-bg: rgb(195, 195, 195);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-light);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Header fijo */
        header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
            background-color: white;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        /* Footer fijo */
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: rgb(248, 249, 250);
            color: black;
            padding: 10px 0;
            text-align: center;
            box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.15);
        }

        /* Espaciado para evitar solapamiento */
        main {
            margin-top: 80px;
            margin-bottom: 60px;
        }

        /* Hero Section */
        .hero {
            background: var(--hero-bg);
            color: rgb(0, 0, 0);
            padding: 80px 0;
            min-height: 80vh;
            display: flex;
            align-items: center;
            text-align: center;
        }

        .hero h1 {
            font-size: 2.8rem;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .btn-hero {
            background-color: var(--accent);
            color: #fff;
            font-weight: 600;
            padding: 12px 30px;
            border: none;
            transition: 0.3s;
        }

        .btn-hero:hover {
            background-color: #ffa63f;
        }

        /* Chat Button */
        .chat-button {
            position: fixed;
            bottom: 80px;
            right: 20px;
            background-color: #1668c0;
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: 0.3s;
            z-index: 99;
        }

        .chat-button:hover {
            background-color: rgb(0, 0, 0);
        }

        /* Responsividad */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.4rem;
            }

            .hero p {
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <img src="{{ asset('images/logosena.png') }}" alt="Logotipo SST" style="width: 80px; height: 65px; object-fit: contain;">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Sistema De Reportes') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
                    <div class="col-md-6 text-center text-md-start">
                        <h1 class="fw-bold">SST SENA</h1>
                        <p>
                            Fomentamos la innovación en la gestión de la seguridad y salud en el trabajo,
                            transformando datos en estrategias que protegen vidas. Nos comprometemos con
                            un futuro laboral de excelencia, donde cada acción impulsa un entorno más seguro,
                            saludable y altamente productivo.
                        </p>
                    </div>

                    <div class="col-md-6">
                        <!-- Carrusel de Imágenes -->
                        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('images/carrusel1.jpg') }}" class="d-block w-100 rounded shadow" alt="Trabajadores con EPI">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('images/carrusel1.jpg') }}" class="d-block w-100 rounded shadow" alt="Seguridad en el trabajo">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Chat Button -->
    <div class="chat-button">
        <i class="bi bi-chat-dots fs-3"></i>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; {{ date('Y') }} SST. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
