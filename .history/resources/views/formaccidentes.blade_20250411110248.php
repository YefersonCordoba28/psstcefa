@extends('instructor/dashboard')

@section('tituloPagina', 'Registro de Accidente')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden mx-auto" style="max-width: 700px;">
        <div class="card-header bg-gradient-to-r from-blue-600 to-blue-800 text-white text-center py-4">
            <h3 class="mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i>Registro de Accidente</h3>
        </div>
        <div class="card-body bg-light px-5 py-4">
            <form id="accidenteForm" action="{{ route('accidentes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Fecha y Hora -->
                <div class="mb-4">
                    <label for="fecha_hora" class="form-label fw-bold">Fecha y Hora:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-calendar-event"></i></span>
                        <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control" required>
                    </div>
                </div>

                <!-- Ubicación -->
                <div class="mb-4">
                    <label for="ubicacion" class="form-label fw-bold">Ubicación del accidente:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-geo-alt-fill"></i></span>
                        <input type="text" name="ubicacion" id="ubicacion" class="form-control" placeholder="Ej. Taller 1, Bloque B" required>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <label for="descripcion_accidente" class="form-label fw-bold">Descripción del accidente:</label>
                    <textarea name="descripcion_accidente" id="descripcion_accidente" rows="4" class="form-control" placeholder="Describe cómo ocurrió el accidente" required></textarea>
                </div>

                <!-- Personas Involucradas -->
                <div class="mb-4">
                    <label for="personas_involucradas" class="form-label fw-bold">Personas involucradas:</label>
                    <textarea name="personas_involucradas" id="personas_involucradas" rows="2" class="form-control" placeholder="Nombres y cargos si es posible..."></textarea>
                </div>

                <!-- Gravedad -->
                <div class="mb-4">
                    <label for="gravedad" class="form-label fw-bold">Gravedad del accidente:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="bi bi-thermometer-half"></i></span>
                        <select name="gravedad" id="gravedad" class="form-select" required>
                            <option value="">Selecciona una opción</option>
                            <option value="Leve">Leve</option>
                            <option value="Moderado">Moderado</option>
                            <option value="Grave">Grave</option>
                        </select>
                    </div>
                </div>

                <!-- Evidencias -->
                <div class="mb-4">
                    <label for="evidencias" class="form-label fw-bold">Subir Evidencia (imagen):</label>
                    <input type="file" name="evidencias" id="evidencias" class="form-control" accept="image/*">
                </div>

                <!-- Creado por -->
                <input type="hidden" name="creado_por" value="{{ auth()->user()->name }}">

                <!-- Botón de enviar -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg px-5">
                        <i class="bi bi-check-circle-fill me-2"></i>Registrar Accidente
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
            title: '¡Accidente registrado!',
            text: 'Tu información ha sido guardada con éxito.',
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
