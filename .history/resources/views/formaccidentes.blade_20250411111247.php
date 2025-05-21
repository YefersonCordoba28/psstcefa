@extends('instructor/dashboard')

@section('tituloPagina', 'Registro de Accidente')

@section('content')
<div class="max-w-3xl mx-auto mt-16 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden border border-blue-200">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-800 to-blue-600 text-white text-center py-6 px-6">
            <h2 class="text-3xl font-bold tracking-wide uppercase">Registrar Accidente</h2>
        </div>

        <!-- Form Body -->
        <div class="px-8 py-10 bg-gray-50">
            <form id="accidenteForm" action="{{ route('accidentes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Fecha y Hora -->
                <div>
                    <label for="fecha_hora" class="block text-lg font-semibold text-blue-900 mb-2">📅 Fecha y Hora</label>
                    <input type="datetime-local" name="fecha_hora" id="fecha_hora" required
                        class="w-full p-3 bg-white text-gray-700 border border-blue-300 rounded-xl shadow-sm transition-all duration-300 focus:ring-4 focus:ring-blue-300 focus:outline-none focus:border-blue-500" />
                </div>

                <!-- Ubicación -->
                <div>
                    <label for="ubicacion" class="block text-lg font-semibold text-blue-900 mb-2">📍 Ubicación</label>
                    <input type="text" name="ubicacion" id="ubicacion" required
                        class="w-full p-3 bg-white text-gray-700 border border-blue-300 rounded-xl shadow-sm transition-all duration-300 focus:ring-4 focus:ring-blue-300 focus:outline-none focus:border-blue-500" />
                </div>

                <!-- Descripción del Accidente -->
                <div>
                    <label for="descripcion_accidente" class="block text-lg font-semibold text-blue-900 mb-2">📝 Descripción del Accidente</label>
                    <textarea name="descripcion_accidente" id="descripcion_accidente" rows="4" required
                        class="w-full p-3 bg-white text-gray-700 border border-blue-300 rounded-xl shadow-sm transition-all duration-300 focus:ring-4 focus:ring-blue-300 focus:outline-none focus:border-blue-500 resize-none"></textarea>
                </div>

                <!-- Personas Involucradas -->
                <div>
                    <label for="personas_involucradas" class="block text-lg font-semibold text-blue-900 mb-2">👥 Personas Involucradas</label>
                    <textarea name="personas_involucradas" id="personas_involucradas" rows="2"
                        class="w-full p-3 bg-white text-gray-700 border border-blue-300 rounded-xl shadow-sm transition-all duration-300 focus:ring-4 focus:ring-blue-300 focus:outline-none focus:border-blue-500 resize-none"></textarea>
                </div>

                <!-- Gravedad -->
                <div>
                    <label for="gravedad" class="block text-lg font-semibold text-blue-900 mb-2">🚨 Nivel de Gravedad</label>
                    <select name="gravedad" id="gravedad" required
                        class="w-full p-3 bg-white text-gray-700 border border-blue-300 rounded-xl shadow-sm transition-all duration-300 focus:ring-4 focus:ring-blue-300 focus:outline-none focus:border-blue-500">
                        <option value="" disabled selected>Selecciona la gravedad</option>
                        <option value="Leve">Leve</option>
                        <option value="Moderado">Moderado</option>
                        <option value="Grave">Grave</option>
                    </select>
                </div>

                <!-- Evidencias -->
                <div>
                    <label for="evidencias" class="block text-lg font-semibold text-blue-900 mb-2">📷 Subir Evidencias (imagen)</label>
                    <input type="file" name="evidencias" id="evidencias" accept="image/*"
                        class="w-full p-3 bg-white text-gray-700 border border-blue-300 rounded-xl shadow-sm transition-all duration-300 focus:ring-4 focus:ring-blue-300 focus:outline-none focus:border-blue-500" />
                </div>

                <!-- Campo oculto -->
                <input type="hidden" name="creado_por" value="{{ auth()->user()->name }}">

                <!-- Botón -->
                <div class="text-center pt-4">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-xl shadow-md transition-all duration-300">
                        <i class="bi bi-save mr-2"></i>Registrar Accidente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('accidenteForm').addEventListener('submit', function (event) {
        event.preventDefault();

        Swal.fire({
            title: '¡Accidente registrado con éxito!',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
</script>
@endsection
