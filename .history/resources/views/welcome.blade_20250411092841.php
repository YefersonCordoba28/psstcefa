<main class="relative isolate overflow-hidden bg-gradient-to-br from-white via-gray-50 to-gray-100 py-24 sm:py-32 lg:py-40">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      
      <!-- Texto atractivo -->
      <div class="relative z-10">
        <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-gray-900 mb-6 leading-tight">
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

      <!-- Imagen/Ilustración con estilo -->
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
  </div>

  <!-- Efecto decorativo -->
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
