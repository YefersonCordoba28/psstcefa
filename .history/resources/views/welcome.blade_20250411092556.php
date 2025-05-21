<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistema de Gestión SST</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body class="bg-white text-gray-800 font-sans">

  <!-- Navbar -->
  <header class="fixed top-0 left-0 right-0 z-50 bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <div class="flex items-center space-x-4">
        <img src="{{ asset('images/logosena.png') }}" alt="Logo SENA" class="h-12 w-auto" />
        <span class="text-xl font-semibold tracking-tight">Sistema SST</span>
      </div>
      <nav class="hidden md:flex space-x-6 text-sm font-medium">
        @guest
          @if (Route::has('login'))
            <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">Iniciar sesión</a>
          @endif
          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600">Registrarse</a>
          @endif
        @else
          <div class="relative group">
            <button class="text-gray-700 font-medium hover:text-blue-600">
              {{ Auth::user()->name }}
            </button>
            <div class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded hidden group-hover:block">
              <a href="{{ route('logout') }}"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                 class="block px-4 py-2 text-gray-700 hover:bg-gray-100 text-sm">Cerrar sesión</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            </div>
          </div>
        @endguest
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <main class="pt-28 pb-16 bg-gradient-to-br from-gray-100 via-white to-gray-50">
    <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
      <!-- Left Text -->
      <div class="animate-fade-in">
        <h1 class="text-5xl font-bold text-gray-900 leading-tight mb-6">
          Bienvenido al Sistema SST
        </h1>
        <p class="text-lg text-gray-700 mb-6 leading-relaxed">
          Innovamos para proteger el bienestar laboral. Convierta datos en acciones estratégicas para un entorno de trabajo seguro, saludable y productivo. Nuestra plataforma está diseñada para facilitar la gestión moderna de la Seguridad y Salud en el Trabajo.
        </p>
        <a href="#"
           class="inline-flex items-center px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg shadow transition">
          <i class="bi bi-arrow-right-circle-fill mr-2"></i> Explorar plataforma
        </a>
      </div>

      <!-- Right Image -->
      <div class="relative animate-fade-slide">
        <div class="rounded-xl overflow-hidden shadow-lg">
          <img src="{{ asset('images/carrusel1.jpg') }}" alt="Seguridad laboral" class="object-cover w-full h-80">
        </div>
      </div>
    </div>
  </main>

  <!-- Features Section -->
  <section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-6 text-center">
      <h2 class="text-3xl font-bold text-gray-900 mb-10">¿Qué ofrece nuestra plataforma?</h2>
      <div class="grid md:grid-cols-3 gap-10 text-left">
        <div class="p-6 bg-gray-50 rounded-xl shadow hover:shadow-md transition">
          <i class="bi bi-shield-check text-4xl text-orange-500 mb-4"></i>
          <h3 class="text-xl font-semibold mb-2">Seguridad Integral</h3>
          <p class="text-gray-600">Protocolos centralizados y control de incidentes en un solo lugar.</p>
        </div>
        <div class="p-6 bg-gray-50 rounded-xl shadow hover:shadow-md transition">
          <i class="bi bi-bar-chart-line text-4xl text-orange-500 mb-4"></i>
          <h3 class="text-xl font-semibold mb-2">Análisis en Tiempo Real</h3>
          <p class="text-gray-600">Visualización de datos con reportes personalizados y métricas clave.</p>
        </div>
        <div class="p-6 bg-gray-50 rounded-xl shadow hover:shadow-md transition">
          <i class="bi bi-people text-4xl text-orange-500 mb-4"></i>
          <h3 class="text-xl font-semibold mb-2">Gestión Colaborativa</h3>
          <p class="text-gray-600">Roles definidos, acceso por perfil y trabajo en equipo optimizado.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Chat Button -->
  <div class="fixed bottom-24 right-6 z-40">
    <button class="w-14 h-14 bg-blue-700 hover:bg-black text-white rounded-full shadow-lg flex items-center justify-center transition">
      <i class="bi bi-chat-dots text-2xl"></i>
    </button>
  </div>

  <!-- Footer -->
  <footer class="bg-gray-100 py-6 mt-20 shadow-inner text-center text-sm text-gray-500">
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
      animation: fade-slide 1.2s ease-out forwards;
    }
  </style>

</body>
</html>
