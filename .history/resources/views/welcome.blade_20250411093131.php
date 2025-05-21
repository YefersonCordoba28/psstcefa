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

  <!-- Hero Main -->
  <main class="relative min-h-[90vh] pt-36 pb-20 bg-gradient-to-tr from-white via-gray-50 to-orange-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col-reverse lg:flex-row items-center gap-16">
      
      <!-- Texto -->
      <div class="lg:w-1/2 text-center lg:text-left">
        <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight leading-tight mb-6 text-gray-900">
          Plataforma SST del <span class="text-orange-500">SENA</span>
        </h1>
        <p class="text-lg text-gray-700 mb-8">
          Innovamos en la gestión de seguridad y salud en el trabajo. Transforma datos en estrategias y acciones que protegen vidas y mejoran el bienestar laboral.
        </p>
        <div class="flex justify-center lg:justify-start gap-4">
          <a href="#" class="px-6 py-3 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600 transition">
            <i class="bi bi-play-circle me-2"></i> Empezar ahora
          </a>
          <a href="#" class="px-6 py-3 border border-orange-500 text-orange-600 rounded-lg font-medium hover:bg-orange-50 transition">
            <i class="bi bi-info-circle me-2"></i> Saber más
          </a>
        </div>
      </div>

      <!-- Imagen o ilustración -->
      <div class="lg:w-1/2">
        <div class="bg-white/70 backdrop-blur-lg shadow-lg border border-gray-200 rounded-2xl overflow-hidden p-4">
          <img src="{{ asset('images/carrusel1.jpg') }}" alt="Seguridad en el trabajo"
               class="rounded-xl w-full h-80 object-cover" />
          <p class="text-sm text-gray-500 text-center mt-2">
            Seguridad laboral con innovación y compromiso institucional.
          </p>
        </div>
      </div>
    </div>

    <!-- Fondo decorativo -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 -z-10">
      <svg class="w-[1200px] h-[1200px] blur-3xl opacity-20" viewBox="0 0 1200 1200" fill="none">
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

  <!-- Botón de chat -->
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
