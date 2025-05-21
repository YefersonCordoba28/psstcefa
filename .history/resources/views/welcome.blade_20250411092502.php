<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistema de Gestión SST</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

  <!-- Navbar -->
  <header class="fixed top-0 w-full bg-white shadow-md z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <div class="flex items-center space-x-4">
        <img src="{{ asset('images/logosena.png') }}" alt="Logo SENA" class="h-12 w-auto" />
        <span class="text-xl font-semibold tracking-wide text-gray-800">
          {{ config('app.name', 'Sistema De Reportes') }}
        </span>
      </div>
      <nav class="space-x-6 text-sm font-medium">
        @guest
          @if (Route::has('login'))
            <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">Login</a>
          @endif
          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600">Registro</a>
          @endif
        @else
          <div class="relative group inline-block">
            <button class="text-gray-700 hover:text-blue-600">{{ Auth::user()->name }}</button>
            <div class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded hidden group-hover:block">
              <a href="{{ route('logout') }}"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                 class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Cerrar sesión</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            </div>
          </div>
        @endguest
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <main class="pt-28 pb-20 bg-gradient-to-r from-gray-100 to-white">
    <section class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
      <!-- Text Content -->
      <div class="animate-fade-in">
        <h1 class="text-5xl font-extrabold text-gray-900 leading-tight mb-6">
          Seguridad y Salud en el Trabajo
        </h1>
        <p class="text-lg text-gray-700 mb-6 leading-relaxed">
          Innovamos en la gestión de riesgos laborales, construyendo entornos seguros y saludables donde cada persona es prioridad. Nuestro compromiso impulsa la productividad con responsabilidad y excelencia institucional.
        </p>
        <a href="#"
           class="inline-block px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg shadow transition">
          Conocer más
        </a>
      </div>

      <!-- Carrusel Simulado -->
      <div class="relative w-full h-72 rounded-xl shadow-lg overflow-hidden animate-fade-slide">
        <img src="{{ asset('images/carrusel1.jpg') }}" alt="Carrusel" class="w-full h-full object-cover transition duration-500 ease-in-out" />
        <!-- Si deseas agregar más imágenes, puedes hacerlo con Alpine.js o JS -->
      </div>
    </section>
  </main>

  <!-- Chat Button -->
  <div class="fixed bottom-24 right-6 z-40">
    <button class="w-14 h-14 bg-blue-700 hover:bg-black text-white rounded-full shadow-lg flex items-center justify-center transition">
      <i class="bi bi-chat-dots text-2xl"></i>
    </button>
  </div>

  <!-- Footer -->
  <footer class="fixed bottom-0 left-0 w-full bg-gray-100 text-sm text-gray-600 py-4 text-center shadow-inner">
    &copy; {{ date('Y') }} SST SENA. Todos los derechos reservados.
  </footer>

  <!-- Animations -->
  <style>
    @keyframes fade-in {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    @keyframes fade-slide {
      0% { opacity: 0; transform: translateX(30px); }
      100% { opacity: 1; transform: translateX(0); }
    }

    .animate-fade-in {
      animation: fade-in 1s ease-out forwards;
    }

    .animate-fade-slide {
      animation: fade-slide 1s ease-out forwards;
    }
  </style>
</body>
</html>
