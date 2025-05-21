@extends('instructor/dashboard')

@section('tituloPagina', 'Registro de Accidente')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-50 px-4 py-12">
    <div class="w-full max-w-2xl bg-white shadow-lg rounded-xl border border-gray-200">
        <!-- Header -->
        <div class="bg-blue-900 text-white text-center py-5 px-6">
            <h2 class="text-2xl font-semibold uppercase tracking-wide">Registro de Accidente</h2>
        </div>

        <!-- Form -->
        <form id="accidenteForm" action="{{ route('accidentes.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf

            <!-- Fecha y Hora -->
            <div>
                <label for="fecha_hora" class="block text-sm font-medium text-gray-700 uppercase tracking-wide mb-2">Fecha y Hora</label>
                <input type="datetime-local" name="fecha_hora" id="fecha_hora" required
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150" />
            </div>

            <!-- Ubicación -->
            <div>
                <label for="ubicacion" class="block text-sm font-medium text-gray-700 uppercase tracking-wide mb-2">Ubicación</label>
                <input type="text" name="ubicacion" id="ubicacion" required
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150" />
            </div>

            <!-- Descripción -->
            <div>
                <label for="descripcion_accidente" class="block text-sm font-medium text-gray-700 uppercase tracking-wide mb-2">Descripción del Accidente</label>
                <textarea name="descripcion_accidente" id="descripcion_accidente" rows="4" required
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 resize-none"></textarea>
            </div>

            <!-- Personas Involucradas -->
            <div>
                <label for="personas_involucradas" class="block text-sm font-medium text-gray-700 uppercase tracking-wide mb-2">Personas Involucradas</label>
                <textarea name="personas_involucradas" id="personas_involucradas" rows="2"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150 resize-none"></textarea>
            </div>

            <!-- Nivel de Gravedad -->
            <div>
                <label for="gravedad" class="block text-sm font-medium text-gray-700 uppercase tracking-wide mb-2">Nivel de Gravedad</label>
                <select name="gravedad" id="gravedad" required
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150">
                    <option value="" disabled selected>Seleccione una opción</option>
                    <option value="Leve">Leve</option>
                    <option value="Moderado">Moderado</option>
                    <option value="Grave">Grave</option>
                </select>
            </div>

            <!-- Subir Evidencia -->
            <div>
                <label for="evidencias" class="block text-sm font-medium text-gray-700 uppercase tracking-wide mb-2">Evidencia (Imagen)</label>
                <input type="file" name="evidencias" id="evidencias" accept="image/*"
                    class="w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition duration-150" />
            </div>

            <!-- Campo Oculto -->
            <input type="hidden" name="creado_por" value="{{ auth()->user()->name }}">

            <!-- Botón -->
            <div class="text-center pt-4">
                <button type="submit"
                    class="bg-blue-900 text-white font-medium px-6 py-3 rounded-md shadow-sm hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-150">
                    Registrar Accidente
                </button>
            </div>
        </form>
    </div>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('accidenteForm').addEventListener('submit', function (event) {
        event.preventDefault();
        Swal.fire({
            title: 'Registro Completado',
            text: 'El accidente ha sido registrado exitosamente.',
            icon: 'success',
            confirmButtonText: 'Aceptar',
            buttonsStyling: false,
            customClass: {
                confirmButton: 'bg-blue-900 text-white px-4 py-2 rounded-md hover:bg-blue-800'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
</script>
@endsection
