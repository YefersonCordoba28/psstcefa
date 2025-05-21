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
    .gradient-text {
      background: linear-gradient(90deg, #f97316, #ea580c);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-800 font-sans">

<!-- Header con diseño profesional combinando azul y naranja -->
<header class="fixed top-0 w-full bg-gradient-to-r from-[#0056D2] to-[#f97316] text-white shadow-md z-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
    <!-- Logo + Título -->
    <div class="flex items-center gap-4">
      <img src="{{ asset('images/logosena.png') }}" alt="Logo SENA" class="w-12 h-12 bg-white p-1 rounded-full" />
      <div>
        <h1 class="text-xl md:text-2xl font-semibold leading-tight">Sistema de Gestión SST</h1>
      </div>
    </div>

    <!-- Menú principal -->
    <nav class="flex items-center gap-6 text-sm font-medium">
      <a href="#" class="text-white hover:text-gray-200 transition-colors duration-300">Login</a>
      <a href="#" class="text-white hover:text-gray-200 transition-colors duration-300">Reportes</a>
      <a href="#" class="text-white hover:text-gray-200 transition-colors duration-300">Contacto</a>
      <a href="#" class="inline-flex items-center px-4 py-2 bg-white text-[#0056D2] rounded-lg font-medium hover:bg-gray-100 transition-colors duration-300">
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
<main class="relative pt-40 pb-24 bg-gradient-to-br from-white via-gray-50 to-white">
  <div class="absolute inset-0 pointer-events-none">
    <svg class="absolute top-0 left-0 w-80 h-80 opacity-10" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
      <circle fill="#f97316" cx="100" cy="100" r="100"/>
    </svg>
    <svg class="absolute bottom-0 right-0 w-64 h-64 opacity-10" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
      <rect fill="#60a5fa" width="200" height="200"/>
    </svg>
  </div>

  <div class="relative max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-12 items-center z-10">
    <!-- Texto -->
    <div class="space-y-6 text-center md:text-left">
      <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
        Protección laboral con <span class="gradient-text">tecnología e innovación</span>
      </h2>
      <p class="text-lg text-gray-600">
        Transformamos datos en estrategias para un entorno de trabajo más seguro, saludable y productivo. Bienvenido al futuro de la gestión en SST.
      </p>
      <div class="flex flex-col sm:flex-row flex-wrap justify-center md:justify-start gap-4">
        <a href="#" class="inline-flex items-center gap-2 px-6 py-3 bg-[#f97316] text-white rounded-lg font-semibold hover:bg-[#ea580c] transition-all duration-300">
          <i class="bi bi-bar-chart-line-fill"></i> Ver Reportes
        </a>
        <a href="#" class="inline-flex items-center gap-2 px-6 py-3 border border-[#f97316] text-[#f97316] rounded-lg font-semibold hover:bg-orange-50 transition-all duration-300">
          <i class="bi bi-info-circle-fill"></i> Saber más
        </a>
      </div>
    </div>

    <!-- Imagen -->
    <div class="relative">
      <div class="rounded-2xl shadow-xl ring-2 ring-gray-200 overflow-hidden transform hover:scale-105 transition duration-500">
        <img src="{{ asset('images/carrusel1.jpg') }}" alt="Seguridad en el trabajo" class="w-full h-80 object-cover" />
      </div>
      <div class="absolute bottom-4 left-4 bg-white/95 text-gray-700 px-4 py-2 rounded-xl shadow backdrop-blur-sm text-sm font-medium">
        Innovando en prevención y bienestar laboral en el SENA.
      </div>
    </div>
  </div>
</main>

<!-- SECCIÓN DE MÉTRICAS -->
<section class="bg-white py-20">
  <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
    <h3 class="text-3xl md:text-4xl font-bold text-gray-800 mb-12">
      Indicadores clave del sistema SST
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
      <div class="flex flex-col items-center p-6 bg-gray-50 rounded-lg shadow-sm hover:shadow-md transition-shadow">
        <i class="bi bi-file-earmark-text-fill text-5xl text-[#f97316] mb-4"></i>
        <h4 class="text-2xl font-semibold text-gray-700">+3.200</h4>
        <p class="text-gray-600 mt-2">Reportes registrados</p>
      </div>

      <div class="flex flex-col items-center p-6 bg-gray-50 rounded-lg shadow-sm hover:shadow-md transition-shadow">
        <i class="bi bi-graph-up-arrow text-5xl text-[#f97316] mb-4"></i>
        <h4 class="text-2xl font-semibold text-gray-700">+1.500</h4>
        <p class="text-gray-600 mt-2">Análisis completados</p>
      </div>

      <div class="flex flex-col items-center p-6 bg-gray-50 rounded-lg shadow-sm hover:shadow-md transition-shadow">
        <i class="bi bi-person-badge-fill text-5xl text-[#f97316] mb-4"></i>
        <h4 class="text-2xl font-semibold text-gray-700">+20</h4>
        <p class="text-gray-600 mt-2">Roles activos en el sistema</p>
      </div>
    </div>
  </div>
</section>

<!-- Botón de chat flotante -->
<div class="fixed bottom-28 right-6 z-50">
  <button class="bg-[#1F2A44] hover:bg-blue-800 text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg transition-all duration-300">
    <i class="bi bi-chat-dots fs-4"></i>
  </button>
</div>

<!-- Footer -->
<footer class="bg-white shadow-inner fixed bottom-0 w-full py-4 border-t border-gray-200 z-40">
  <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-600">
    © {{ date('Y') }} SST. Todos los derechos reservados.
  </div>
</footer>

</body>
</html>