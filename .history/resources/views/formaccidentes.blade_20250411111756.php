@extends('instructor/dashboard')

@section('tituloPagina', 'Registro de Accidente')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-4xl">
        <!-- Card Container -->
        <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-blue-100 transform transition-all hover:shadow-2xl">
            <!-- Header with Gradient -->
            <div class="bg-gradient-to-r from-blue-700 to-blue-500 py-6 px-8 text-center">
                <h1 class="text-3xl font-bold text-white uppercase tracking-wider">
                    <i class="bi bi-exclamation-triangle-fill mr-2"></i>Registro de Accidente
                </h1>
                <p class="mt-2 text-blue-100">Complete todos los campos requeridos</p>
            </div>

            <!-- Form Body -->
            <div class="p-8 space-y-6">
                <form id="accidenteForm" action="{{ route('accidentes.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @csrf

                    <!-- Columna Izquierda -->
                    <div class="space-y-6 md:col-span-1">
                        <!-- Fecha y Hora -->
                        <div>
                            <label for="fecha_hora" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i class="bi bi-calendar-event mr-2 text-blue-600"></i>Fecha y Hora*
                            </label>
                            <input type="datetime-local" name="fecha_hora" id="fecha_hora" required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                        </div>

                        <!-- Ubicación -->
                        <div>
                            <label for="ubicacion" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i class="bi bi-geo-alt-fill mr-2 text-blue-600"></i>Ubicación*
                            </label>
                            <input type="text" name="ubicacion" id="ubicacion" required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                placeholder="Ej: Taller de mecánica, Aula 203">
                        </div>

                        <!-- Gravedad -->
                        <div>
                            <label for="gravedad" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i class="bi bi-exclamation-octagon-fill mr-2 text-blue-600"></i>Nivel de Gravedad*
                            </label>
                            <select name="gravedad" id="gravedad" required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-300">
                                <option value="" disabled selected>Seleccione una opción</option>
                                <option value="Leve">Leve (Sin lesiones)</option>
                                <option value="Moderado">Moderado (Lesiones menores)</option>
                                <option value="Grave">Grave (Lesiones mayores/hospitalización)</option>
                            </select>
                        </div>

                        <!-- Evidencias -->
                        <div>
                            <label for="evidencias" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i class="bi bi-camera-fill mr-2 text-blue-600"></i>Evidencias Fotográficas
                            </label>
                            <div class="mt-1 flex items-center">
                                <label class="cursor-pointer bg-white px-4 py-2 border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 transition duration-300 w-full">
                                    <span class="text-sm text-gray-600">Seleccionar archivo...</span>
                                    <input type="file" name="evidencias" id="evidencias" accept="image/*" class="hidden">
                                </label>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Formatos aceptados: JPG, PNG (Máx. 5MB)</p>
                        </div>
                    </div>

                    <!-- Columna Derecha -->
                    <div class="space-y-6 md:col-span-1">
                        <!-- Descripción -->
                        <div>
                            <label for="descripcion_accidente" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i class="bi bi-card-text mr-2 text-blue-600"></i>Descripción Detallada*
                            </label>
                            <textarea name="descripcion_accidente" id="descripcion_accidente" rows="5" required
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                placeholder="Describa cómo ocurrió el accidente, causas observadas, etc."></textarea>
                        </div>

                        <!-- Personas Involucradas -->
                        <div>
                            <label for="personas_involucradas" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                <i class="bi bi-people-fill mr-2 text-blue-600"></i>Personas Involucradas
                            </label>
                            <textarea name="personas_involucradas" id="personas_involucradas" rows="3"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-300"
                                placeholder="Nombres y roles de las personas involucradas (separados por comas)"></textarea>
                        </div>
                    </div>

                    <!-- Campo oculto -->
                    <input type="hidden" name="creado_por" value="{{ auth()->user()->name }}">

                    <!-- Botón de envío (full width) -->
                    <div class="md:col-span-2 pt-4">
                        <button type="submit"
                            class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-lg font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300">
                            <i class="bi bi-save-fill mr-2"></i>Registrar Accidente
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Nota legal -->
        <div class="mt-4 text-center text-xs text-gray-500">
            <p>* Campos obligatorios. Todos los registros están sujetos a verificación.</p>
        </div>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('accidenteForm').addEventListener('submit', function(event) {
        event.preventDefault();
        
        // Validación adicional si es necesaria
        
        Swal.fire({
            title: '¿Confirmar registro?',
            text: "Por favor verifique que toda la información es correcta",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, registrar',
            cancelButtonText: 'Revisar datos'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
</script>
@endsection