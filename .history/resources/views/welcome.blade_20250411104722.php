<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión SST</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap Icons (retained for icons) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="font-sans bg-gray-100 text-gray-800">

    <!-- Fixed Header -->
    <header class="fixed top-0 w-full bg-white shadow-lg z-50">
        <nav class="container mx-auto px-4 py-3 flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/logosena.png') }}" alt="Logotipo SST" class="w-16 h-14 object-contain">
                <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">{{ config('app.name', 'Sistema De Reportes') }}</a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="menu-toggle" class="md:hidden text-gray-600 focus:outline-none">
                <i class="bi bi-list text-2xl"></i>
            </button>

            <!-- Navbar Links -->
            <div id="navbar-menu" class="hidden md:flex items-center space-x-6">
                <ul class="flex space-x-4">
                    @guest
                        @if (Route::has('login'))
                            <li>
                                <a href="{{ route('login') }}" class="text-gray-600 hover:text-orange-500 transition">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li>
                                <a href="{{ route('register') }}" class="text-gray-600 hover:text-orange-500 transition">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="relative group">
                            <a href="#" class="text-gray-600 hover:text-orange-500 transition flex items-center space-x-1">
                                <span>{{ Auth::user()->name }}</span>
                                <i class="bi bi-chevron-down"></i>
                            </a>
                            <div class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg hidden group-hover:block">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                   class="block px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg">
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
    <main class="pt-24 pb-20">
        <!-- Hero Section -->
        <section class="bg-gray-200 py-16 min-h-[80vh] flex items-center">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row items-center gap-12">
                    <!-- Text Content -->
                    <div class="md:w-1/2 text-center md:text-left">
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">SST SENA</h1>
                        <p class="text-lg text-gray-600 mb-6">
                            Fomentamos la innovación en la gestión de la seguridad y salud en el trabajo,
                            transformando datos en estrategias que protegen vidas. Nos comprometemos con
                            un futuro laboral de excelencia, donde cada acción impulsa un entorno más seguro,
                            saludable y altamente productivo.
                        </p>
                        <a href="#"
                           class="inline-block bg-orange-500 text-white font-semibold py-3 px-6 rounded-lg hover:bg-orange-600 transition">
                            Conoce Más
                        </a>
                    </div>
                    <!-- Image -->
                    <div class="md:w-1/2">
                        <img src="{{ asset('images/carrusel1.jpg') }}"
                             alt="Seguridad en el trabajo"
                             class="w-full rounded-lg shadow-xl object-cover">
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Chat Button -->
    <div class="fixed bottom-24 right-6 bg-blue-600 text-white w-16 h-16 rounded-full flex items-center justify-center shadow-xl hover:bg-blue-700 transition cursor-pointer z-40">
        <i class="bi bi-chat-dots text-2xl"></i>
    </div>

    <!-- Fixed Footer -->
    <footer class="fixed bottom-0 w-full bg-gray-50 shadow-inner text-center py-3">
        <div class="container mx-auto px-4">
            <p class="text-gray-600">© {{ date('Y') }} SST. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        document.getElementById('menu-toggle').addEventListener('click', () => {
            const menu = document.getElementById('navbar-menu');
            menu.classList.toggle('hidden');
        });
    </script>

</body>

</html>