<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión SST</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        /* Custom animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        /* Smooth carousel transition */
        .carousel-item { transition: opacity 0.5s ease-in-out; }
    </style>
</head>

<body class="font-sans bg-gradient-to-b from-gray-50 to-gray-100 text-gray-900">

    <!-- Fixed Header -->
    <header class="fixed top-0 w-full bg-white/95 backdrop-blur-sm shadow-md z-50">
        <nav class="container mx-auto px-6 py-4 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/logosena.png') }}" alt="Logotipo SST" class="w-16 h-14 object-contain transition-transform hover:scale-105">
                <a href="{{ url('/') }}" class="text-2xl font-extrabold text-gray-800 tracking-tight">{{ config('app.name', 'Sistema De Reportes') }}</a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="menu-toggle" class="md:hidden text-gray-700 hover:text-orange-500 focus:outline-none">
                <i class="bi bi-list text-3xl"></i>
            </button>

            <!-- Navbar Links -->
            <div id="navbar-menu" class="hidden md:flex items-center space-x-8">
                <ul class="flex space-x-6">
                    @guest
                        @if (Route::has('login'))
                            <li>
                                <a href="{{ route('login') }}" class="text-gray-600 hover:text-orange-500 font-medium transition duration-300">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}" class="text-gray-600 hover:text-orange-500 font-medium transition duration-300">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="relative group">
                            <a href="#" class="text-gray-600 hover:text-orange-500 font-medium transition duration-300 flex items-center space-x-2">
                                <span>{{ Auth::user()->name }}</span>
                                <i class="bi bi-chevron-down text-sm"></i>
                            </a>
                            <div class="absolute right-0 mt-2 w-56 bg-white shadow-xl rounded-xl overflow-hidden hidden group-hover:block transition-all duration-300">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                   class="block px-5 py-3 text-gray-600 hover:bg-orange-50 hover:text-orange-500 transition duration-200">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="pt-28 pb-24">
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-gray-200 via-gray-300 to-gray-200 py-20 min-h-[85vh] flex items-center">
            <div class="container mx-auto px-6">
                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <!-- Text Content -->
                    <div class="lg:w-1/2 text-center lg:text-left animate-fadeInUp">
                        <h1 class="text-5xl lg:text-6xl font-extrabold text-gray-900 mb-6 leading-tight tracking-tight">
                            SST SENA
                        </h1>
                        <p class="text-xl text-gray-700 mb-8 max-w-2xl mx-auto lg:mx-0">
                            Transformamos la seguridad y salud en el trabajo con innovación, convirtiendo datos en estrategias que salvan vidas y fomentan entornos laborales productivos y seguros.
                        </p>
                        <div class="flex justify-center lg:justify-start space-x-4">
                            <a href="#"
                               class="inline-block bg-orange-500 text-white font-semibold py-3 px-8 rounded-full hover:bg-orange-600 transition duration-300 shadow-lg hover:shadow-xl">
                                Descubre Más
                            </a>
                            <a href="{{ route('login') }}"
                               class="inline-block bg-transparent border-2 border-orange-500 text-orange-500 font-semibold py-3 px-8 rounded-full hover:bg-orange-50 transition duration-300">
                                Iniciar Sesión
                            </a>
                        </div>
                    </div>
                    <!-- Carousel -->
                    <div class="lg:w-1/2">
                        <div id="heroCarousel" class="relative w-full h-96 rounded-2xl overflow-hidden shadow-2xl">
                            <div class="carousel-item absolute inset-0 opacity-100">
                                <img src="{{ asset('images/carrusel1.jpg') }}"
                                     alt="Seguridad en el trabajo"
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="carousel-item absolute inset-0 opacity-0">
                                <img src="{{ asset('images/carrusel2.jpg') }}"
                                     alt="Trabajadores con EPI"
                                     class="w-full h-full object-cover">
                            </div>
                            <!-- Carousel Controls -->
                            <button id="prevSlide" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 p-3 rounded-full shadow-md hover:bg-white transition">
                                <i class="bi bi-chevron-left text-gray-800"></i>
                            </button>
                            <button id="nextSlide" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 p-3 rounded-full shadow-md hover:bg-white transition">
                                <i class="bi bi-chevron-right text-gray-800"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Chat Button -->
        <div class="fixed bottom-28 right-8 bg-gradient-to-br from-blue-600 to-blue-700 text-white w-16 h-16 rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform duration-300 cursor-pointer z-40">
            <i class="bi bi-chat-dots text-2xl"></i>
        </div>

        <!-- Fixed Footer -->
        <footer class="fixed bottom-0 w-full bg-white/95 backdrop-blur-sm shadow-inner text-center py-4">
            <div class="container mx-auto px-6">
                <p class="text-gray-600 text-sm">© {{ date('Y') }} SST. Todos los derechos reservados.</p>
            </div>
        </footer>

        <!-- Scripts -->
        <script>
            // Mobile Menu Toggle
            document.getElementById('menu-toggle').addEventListener('click', () => {
                const menu = document.getElementById('navbar-menu');
                menu.classList.toggle('hidden');
            });

            // Simple Carousel Logic
            const carousel = document.getElementById('heroCarousel');
            const items = carousel.querySelectorAll('.carousel-item');
            let currentIndex = 0;

            function showSlide(index) {
                items.forEach((item, i) => {
                    item.classList.toggle('opacity-100', i === index);
                    item.classList.toggle('opacity-0', i !== index);
                });
            }

            document.getElementById('nextSlide').addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % items.length;
                showSlide(currentIndex);
            });

            document.getElementById('prevSlide').addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + items.length) % items.length;
                showSlide(currentIndex);
            });

            // Auto-slide every 5 seconds
            setInterval(() => {
                currentIndex = (currentIndex + 1) % items.length;
                showSlide(currentIndex);
            }, 5000);
        </script>

    </body>
</html>