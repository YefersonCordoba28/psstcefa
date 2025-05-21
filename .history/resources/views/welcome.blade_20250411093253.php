<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistema de Gestión SST</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-900">

  <!-- Navbar fijo -->
  <header class="bg-white shadow fixed top-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
      <div class="flex items-center gap-4">
        <img src="{{ asset('images/logosena.png') }}" alt="Logotipo SST" class="w-16 h-14 object-contain" />
        <h1 class="text-xl font-bold text-gray-800">Sistema de Gestión SST</h1>
      </div>
      <nav class="hidden md:flex gap-6">
        <a href="#" class="text-gray-600 hover:text-orange-500 font-medium">Inicio</a>
        <a href="#" class="text-gray-600 hover:text-orange-500 font-medium">Acerca</a>
        <a href="#" class="text-gray-600 hover:text-orange-500 font-medium">Contacto</a>
      </nav>
    </div>
  </header>

  <!-- Nuevo diseño del Main -->
  <main class="pt-32 pb-20 bg-gradient-to-br from-white to-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
      
      <!-- Contenido textual -->
      <div>
        <h2 class="text-4xl font-extrabold text-gray-800 leading-snug mb-6">
          Seguridad y Salud Laboral<br><span class="text-orange-500">con tecnología e innovación</span>
        </h2>
        <p class="text-lg text-gray-600 mb-6">
          Nuestra plataforma impulsa la excelencia en la gestión de riesgos laborales, promoviendo entornos de trabajo seguros, saludables y productivos en todo el SENA.
        </p>
        <div class="flex gap-4 flex-wrap">
          <a href="#" class="px-6 py-3 bg-orange-500 text-white rounded-lg font-medium hover:bg-orange-600 transition">
            Ver reportes
          </a>
          <a href="#" class="px-6 py-3 border border-orange-500 text-orange-600 rounded-lg font-medium hover:bg-orange-100 transition">
            Más información
          </a>
        </div>
      </div>

      <!-- Imagen / Carrusel -->
      <div class="w-full">
        <div class="relative rounded-2xl overflow-hidden shadow-lg ring-1 ring-gray-200">
          <div class="aspect-video">
            <img src="{{ asset('images/carrusel1.jpg') }}" alt="Seguridad en el trabajo"
                 class="w-full h-full object-cover" />
          </div>
          <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/70 to-transparent text-white px-4 py-3 text-sm">
            Compromiso con la seguridad laboral del país
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Botón de chat flotante -->
  <div class="fixed bottom-24 right-6 z-50">
    <button class="bg-blue-600 hover:bg-black text-white rounded-full w-14 h-14 flex items-center justify-center shadow-lg transition">
      <i class="bi bi-chat-dots fs-4 text-white"></i>
    </button>
  </div>

  <!-- Footer fijo -->
  <footer class="bg-white shadow fixed bottom-0 w-full py-3 border-t z-40">
    <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-600">
      &copy; {{ date('Y') }} SST. Todos los derechos reservados.
    </div>
  </footer>

</body>
</html>
