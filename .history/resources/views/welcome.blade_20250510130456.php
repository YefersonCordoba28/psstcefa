<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistema de Gestión SST</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    .highlight-text {
      color: #0056D2; /* BBVA Blue */
    }
  </style>
</head>

<body class="bg-white text-gray-800 font-sans">

<!-- Header limpio y profesional al estilo BBVA -->
<header class="fixed top-0 w-full bg-white text-gray-800 shadow-sm z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
    <!-- Logo + Título -->
    <div class="flex items-center gap-4">
      <img src="{{ asset('images/logosena.png') }}" alt="Logo SENA" class="w-12 h-12 bg-white p-1 rounded-full" />
      <div>
        <h1 class="text-xl md:text-2xl font-semibold text-[#0056D2] leading-tight tracking-tight">Sistema de Gestión SST</h1>
      </div>
    </div>

    <!-- Menú hamburguesa para móviles -->
    <button id="menu-toggle" class="md:hidden text-3xl focus:outline-none text-gray-600 hover:text-[#0056D2] transition-colors">
      <i class="bi bi-list"></i>
    </button>

    <!-- Menú principal -->
    <nav id="menu" class="hidden md:flex flex-col md:flex-row md:items-center gap-4 text-sm font-medium absolute md:static top-16 right-4 bg-white md:bg-transparent shadow-md md:shadow-none p-4 md:p-0 rounded-lg md:rounded-none transition-all duration-300 ease-in-out">
      @if (Route::has('login'))
        <a class="relative text-gray-600 hover:text-[#0056D2] transition-colors duration-300" href="{{ route('login') }}">{{ __('Login') }}</a>
      @endif
      <a href="#" class="relative text-gray-600 hover:text-[#0056D2] transition-colors duration-300">Reportes</a>
      <a href="#" class="relative text-gray-600 hover:text-[#0056D2] transition-colors duration-300">Contacto</a>
      <a href="#" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0056D2] text-white rounded-lg font-medium hover:bg-blue-700 transition-colors duration-300">
        Acceso
      </a>
    </nav>
  </div>
</header>

<!-- Script para abrir/cerrar menú -->
<script>
  const menuToggle = document.getElementById('menu-toggle');
  const menu = document.getElementById('menu');

  menuToggle.addEventListener('click', () => {
    menu.classList.toggle('hidden');
  });
</script>

<!-- CONTENIDO PRINCIPAL -->
<main class="relative pt-24 pb-16 bg-white">
  <div class="relative max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-10 items-center z-10">
    <!-- Texto -->
    <div class="space-y-6 text-center md:text-left">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight">
        Protección laboral con <span class="highlight-text">tecnología e innovación</span>
      </h2>
      <p class="text-base text-gray-600">
        Transformamos datos en estrategias para un entorno de trabajo más seguro, saludable y productivo. Bienvenido al futuro de la gestión en SST.
      </p>
      <div class="flex flex-col sm:flex-row flex-wrap justify-center md:justify-start gap-4">
        <a href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-[#0056D2] text-white rounded-lg font-medium hover:bg-blue-700 transition-all duration-300">
          Conoce más
        </a>
      </div>
    </div>

    <!-- Imagen -->
    <div class="relative">
      <div class="rounded-lg overflow-hidden transform transition duration-300">
        <img src="{{ asset('images/carrusel1.jpg') }}" alt="Seguridad en el trabajo" class="w-full h-80 object-cover" />
      </div>
    </div>
  </div>
</main>

<!-- SECCIÓN DE MÉTRICAS -->
<section class="bg-gray-50 py-16">
  <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
    <h3 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-10">
      Indicadores clave del sistema SST
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div class="flex flex-col items-center p-6 bg-white rounded-lg shadow-sm">
        <i class="bi bi-file-earmark-text-fill text-4xl text-[#0056D2] mb-4"></i>
        <h4 class="text-xl font-semibold text-gray-700">+3.200</h4>
        <p class="text-gray-600 mt-2">Reportes registrados</p>
      </div>

      <div class="flex flex-col items-center p-6 bg-white rounded-lg shadow-sm">
        <i class="bi bi-graph-up-arrow text-4xl text-[#0056D2] mb-4"></i>
        <h4 class="text-xl font-semibold text-gray-700">+1.500</h4>
        <p class="text-gray-600 mt-2">Análisis completados</p>
      </div>

      <div class="flex flex-col items-center p-6 bg-white rounded-lg shadow-sm">
        <i class="bi bi-person-badge-fill text-4xl text-[#0056D2] mb-4"></i>
        <h4 class="text-xl font-semibold text-gray-700">+20</h4>
        <p class="text-gray-600 mt-2">Roles activos en el sistema</p>
      </div>
    </div>
  </div>
</section>

<!-- Botón de chat flotante -->
<div class="fixed bottom-16 right-6 z-50">
  <button class="bg-[#0056D2] hover:bg-blue-700 text-white rounded-full w-12 h-12 flex items-center justify-center shadow-lg transition-all duration-300">
    <i class="bi bi-chat-dots fs-5"></i>
  </button>
</div>

<!-- Footer -->
<footer class="bg-white shadow-inner fixed bottom-0 w-full py-3 border-t border-gray-200 z-40">
  <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-600">
    © {{ date('Y') }} SST. Todos los derechos reservados.
  </div>
</footer>

</body>
</html>