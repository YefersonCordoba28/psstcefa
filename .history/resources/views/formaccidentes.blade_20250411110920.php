@extends('instructor/dashboard')

@section('tituloPagina', 'Registro de Accidente')

@section('content')
<div class="max-w-3xl mx-auto mt-16 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-blue-100">
        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-700 to-blue-500 text-white text-center py-5 px-6">
            <h2 class="text-2xl font-bold tracking-wide">Registrar Accidente</h2>
        </div>

        <!-- Body -->
        <div class="px-6 py-8 bg-blue-50">
            <form id="accidenteForm" action="{{ route('accidentes.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Fecha y Hora -->
                <div>
                    <label for="fecha_hora" class="block text-blue-900 font-semibold mb-1">Fecha y Hora</label>
                    <div class="flex items-center border border-blue-300 rounded-lg overflow-hidden shadow-sm bg-white">
                        <span class="px-3 bg-blue-100 text-blue-600">
                            <i class="bi bi-calendar-date"></i>
                        </span>
                        <input type="datetime-local" name="fecha_hora" id="fecha_hora" required class="w-full p-2.5 border-none focus:outline-none focus:ring-2 focus:ring-blue-300" />
                    </div>
                </div>

                <!-- Ubicación -->
                <div>
                    <label for="ubicacion" class="block text-blue-900 font-semibold mb-1">Ubicación</label>
                    <div class="flex items-center border border-blue-300 rounded-lg overflow-hidden shadow-sm bg-white">
                        <span class="px-3 bg-blue-100 text-blue-600">
                            <i class="bi bi-geo-alt"></i>
                        </span>
                        <input type="text" name="ubicacion" id="ubicacion" required class="w-full p-2.5 border-none focus:outline-none focus:ring-2 focus:ring-blue-300" />
                    </div>
                </div>

                <!-- Descripción del Accidente -->
                <div>
                    <label for="descripcion_accidente" class="block text-blue-900 font-semibold mb-1">Descripción del Accidente</label>
                    <textarea name="descripcion_accidente" id="descripcion_accidente" rows="3" required class="w-full p-3 border border-blue-300 rounded-lg shadow-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                </div>

                <!-- Personas Involucradas -->
                <div>
                    <label for="personas_involucradas" class="block text-blue-900 font-semibold mb-1">Personas Involucradas</label>
                    <textarea name="personas_involucradas" id="personas_involucradas" rows="2" class="w-full p-3 border border-blue-300 rounded-lg shadow-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                </div>

                <!-- Gravedad -->
                <div>
                    <label for="gravedad" class="block text-blue-900 font-semibold mb-1">Gravedad</label>
                    <select name="gravedad" id="gravedad" required class="w-full border border-blue-300 rounded-lg p-2.5 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <option value="">Selecciona la gravedad</option>
                        <option value="Leve">Leve</option>
                        <option value="Moderado">Moderado</option>
                        <option value="Grave">Grave</option>
                    </select>
                </div>

                <!-- Evidencias -->
                <div>
                    <label for="evidencias" class="block text-blue-900 font-semibold mb-1">Subir Evidencias (imagen)</label>
                    <input type="file" name="evidencias" id="evidencias" accept="image/*" class="w-full border border-blue-300 rounded-lg p-2.5 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400" />
                </div>

                <!-- Campo oculto para creado por -->
                <input type="hidden" name="creado_por" value="{{ auth()->user()->name }}">

                <!-- Botón -->
                <div class="text-center">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition-all duration-200">
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
    document.getElementById('accidenteForm').addEventListener('submit', function(event) {
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
