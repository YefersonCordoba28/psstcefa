<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistema de Gestión SST</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900">

  <!-- Navbar -->
  <header class="bg-white shadow fixed top-0 inset-x-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
      <div class="flex items-center space-x-4">
        <img src="{{ asset('images/logosena.png') }}" alt="Logotipo SST" class="w-16 h-14 object-contain" />
        <span class="text-xl font-bold text-gray-800">Sistema de Gestión SST</span>
      </div>
      <nav class="hidden md:flex space-x-6">
        <a href="#" class="text-gray-600 hover:text-orange-500 font-medium">Inicio</a>
        <a href="#" class="text-gray-600 hover:text-orange-500 font-medium">Acerca</a>
        <a href="#" class="text-gray-600 hover:text-orange-500 font-medium">Contacto</a>
      </nav>
    </div>
  </header>

  <!-- Main Hero Section -->
  <main class="relative isolate overflow-hidden bg-gradient-to-br from-white via-gray-50 to-gray-100 py-32 px-4 sm:px-6 lg:px-8 mt-20">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
      <!-- Text Content -->
      <div class="z-10">
        <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-gray-900 mb-6">
          Bienvenido al Sistema SST del SENA
        </h1>
        <p class="text-lg text-gray-700 mb-8">
          Una plataforma inteligente para promover entornos laborales seguros, saludables y eficientes. Convierta datos en decisiones que salvan vidas y potencian la productividad.
        </p>
        <div class="flex space-x-4">
          <a href="#"
             class="inline-flex items-center px-6 py-3 text-white bg-orange-500 hover:bg-orange-600 font-semibold rounded-lg shadow transition">
            <i class="bi bi-graph-up-arrow mr-2"></i> Comenzar
          </a>
          <a href="#"
             class="inline-flex items-center px-6 py-3 text-orange-600 border border-orange-500 hover:bg-orange-50 font-medium rounded-lg transition">
            <i class="bi bi-info-circle mr-2"></i> Saber más
          </a>
        </div>
      </div>

      <!-- Image Section -->
      <div class="relative">
        <div class="bg-white/50 backdrop-blur-xl border border-gray-200 rounded-3xl p-6 shadow-xl ring-1 ring-gray-100">
          <img src="{{ asset('images/carrusel1.jpg') }}" alt="Seguridad en el trabajo"
               class="rounded-2xl w-full h-80 object-cover shadow-md" />
          <p class="mt-4 text-center text-sm text-gray-500">
            Gestión moderna y efectiva en Seguridad y Salud en el Trabajo
          </p>
        </div>
      </div>
    </div>

    <!-- Decorative SVG -->
    <div class="absolute -z-10 inset-0 overflow-hidden pointer-events-none">
      <svg class="absolute top-0 left-1/2 -translate-x-1/2 blur-3xl opacity-25" width="1200" height="1200" fill="none">
        <circle cx="600" cy="200" r="400" fill="url(#gradient)" />
        <defs>
          <radialGradient id="gradient" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse"
                          gradientTransform="translate(600 200) rotate(90) scale(400)">
            <stop stop-color="#f97316" />
            <stop offset="1" stop-color="#facc15" stop-opacity="0" />
          </radialGradient>
        </defs>
      </svg>
    </div>
  </main>

  <!-- Chat Button -->
  <div class="fixed bottom-24 right-6 z-50">
    <button class="bg-blue-600 hover:bg-black text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg transition">
      <i class="bi bi-chat-dots fs-4 text-white"></i>
    </button>
  </div>

  <!-- Footer -->
  <footer class="bg-white border-t mt-16 py-4">
    <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-600">
      &copy; {{ date('Y') }} SST. Todos los derechos reservados.
    </div>
  </footer>

</body>
</html>
