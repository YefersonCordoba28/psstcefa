<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Gestión SST</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800 font-sans">

  <!-- Navbar -->
  <header class="fixed top-0 left-0 w-full bg-white shadow z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between h-16">
      <div class="flex items-center space-x-3">
        <img src="{{ asset('images/logosena.png') }}" alt="Logo SENA" class="h-12 w-auto">
        <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">
          {{ config('app.name', 'Sistema De Reportes') }}
        </a>
      </div>
      <div>
        <ul class="flex space-x-4">
          @guest
            @if (Route::has('login'))
              <li><a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium">Login</a></li>
            @endif
            @if (Route::has('register'))
              <li><a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600 font-medium">Register</a></li>
            @endif
          @else
            <li class="relative group">
              <button class="text-gray-700 font-medium group-hover:text-blue-600">
                {{ Auth::user()->name }}
              </button>
              <div class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded hidden group-hover:block">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
              </div>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="pt-24 pb-20">
    <section class="bg-gray-100 py-16">
      <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
        <!-- Texto -->
        <div>
          <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6">
            SST SENA
          </h1>
          <p class="text-lg text-gray-700 mb-6">
            Fomentamos la innovación en la gestión de la seguridad y salud en el trabajo, transformando datos en estrategias que protegen vidas. Comprometidos con un futuro laboral de excelencia.
          </p>
          <a href="#"
             class="inline-block bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-lg shadow transition">
            Conoce más
          </a>
        </div>

        <!-- Carrusel -->
        <div class="relative">
          <div class="relative w-full h-72 rounded-lg overflow-hidden shadow-lg">
            <div class="absolute inset-0 animate-fade-slide" id="carousel">
              <img src="{{ asset('images/carrusel1.jpg') }}" class="w-full h-full object-cover" alt="Carrusel 1">
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Chat Button -->
  <div class="fixed bottom-24 right-6 z-40">
    <button class="w-14 h-14 bg-blue-600 hover:bg-black text-white rounded-full shadow-lg flex items-center justify-center">
      <i class="bi bi-chat-dots text-2xl"></i>
    </button>
  </div>

  <!-- Footer -->
  <footer class="fixed bottom-0 left-0 w-full bg-gray-100 text-center py-3 shadow-inner text-sm text-gray-600">
    &copy; {{ date('Y') }} SST. Todos los derechos reservados.
  </footer>

  <!-- Optional: Tailwind plugin for animations -->
  <style>
    @keyframes fade-slide {
      0% { opacity: 0; transform: translateX(20px); }
      100% { opacity: 1; transform: translateX(0); }
    }

    .animate-fade-slide {
      animation: fade-slide 1.2s ease-out forwards;
    }
  </style>

</body>

</html>
