<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistema de Gestión SST</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  </head>

  <body class="bg-gray-50 text-gray-800">

    <!-- Header fijo -->
    <header class="fixed top-0 w-full bg-white shadow z-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
          <img src="{{ asset('images/logosena.png') }}" alt="Logo" class="w-16 h-14 object-contain" />
          <h1 class="text-xl md:text-2xl font-bold text-gray-700">Sistema de Gestión SST</h1>
        </div>
        <nav class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-600">
        @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
          <a href="#" class="hover:text-orange-500 transition">Reportes</a>
          <a href="#" class="hover:text-orange-500 transition">Contacto</a>
        </nav>
      </div>
    </header>

    <!-- Hero principal (Main) -->
    <main class="pt-32 pb-20 bg-gradient-to-br from-gray-100 to-white">
      <div class="max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
        <!-- Texto -->
        <div>
          <h2 class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-6 leading-tight">
            Protección laboral <br /><span class="text-orange-500">con tecnología e innovación</span>
          </h2>
          <p class="text-lg text-gray-600 mb-6">
            Transformamos datos en estrategias para un entorno de trabajo más seguro, saludable y productivo. Bienvenido al futuro de la gestión en SST.
          </p>
          <div class="flex gap-4 flex-wrap">
            <a href="#" class="px-6 py-3 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600 transition">
              Ver Reportes
            </a>
            <a href="#" class="px-6 py-3 border border-orange-500 text-orange-600 rounded-lg font-semibold hover:bg-orange-100 transition">
              Saber más
            </a>
          </div>
        </div>

        <!-- Imagen destacada -->
        <div class="relative rounded-2xl overflow-hidden shadow-xl ring-1 ring-gray-300">
          <img src="{{ asset('images/carrusel1.jpg') }}" alt="Seguridad en el trabajo"
            class="w-full h-full object-cover" />
          <div class="absolute bottom-0 bg-gradient-to-t from-black/70 to-transparent text-white px-6 py-4 text-sm md:text-base">
            Innovando en prevención y bienestar laboral en el SENA.
          </div>
        </div>
      </div>
    </main>

    <!-- SECCIÓN DE MÉTRICAS ACTUALIZADA -->
    <section class="bg-white py-16">
      <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
        <h3 class="text-3xl md:text-4xl font-bold text-gray-800 mb-12">
          Indicadores clave del sistema SST
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
          
          <!-- Reportes registrados -->
          <div class="flex flex-col items-center">
            <i class="bi bi-file-earmark-text-fill text-5xl text-orange-500 mb-4"></i>
            <h4 class="text-2xl font-semibold text-gray-700">+3.200</h4>
            <p class="text-gray-600 mt-2">Reportes registrados</p>
          </div>

          <!-- Análisis completados -->
          <div class="flex flex-col items-center">
            <i class="bi bi-graph-up-arrow text-5xl text-orange-500 mb-4"></i>
            <h4 class="text-2xl font-semibold text-gray-700">+1.500</h4>
            <p class="text-gray-600 mt-2">Análisis completados</p>
          </div>

          <!-- Roles activos -->
          <div class="flex flex-col items-center">
            <i class="bi bi-person-badge-fill text-5xl text-orange-500 mb-4"></i>
            <h4 class="text-2xl font-semibold text-gray-700">+20</h4>
            <p class="text-gray-600 mt-2">Roles activos en el sistema</p>
          </div>

        </div>
      </div>
    </section>

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
