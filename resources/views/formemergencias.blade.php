@extends('instructor/dashboard')

@section('tituloPagina', 'Registro de Emergencia')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg" style="max-width: 600px; margin: auto;">
            <div class="card-header bg-primary text-white text-center">
                <h4>Registrar Emergencia</h4>
            </div>
            <div class="card-body bg-light p-4">
                <form id="emergenciaForm" action="{{ route('emergencias.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Fecha y Hora -->
                    <div class="mb-3">
                        <label for="fecha_hora" class="form-label">Fecha y Hora:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                            <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control" required>
                        </div>
                    </div>

                    <!-- Ubicación -->
                    <div class="mb-3">
                        <label for="ubicacion" class="form-label">Ubicación:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" name="ubicacion" id="ubicacion" class="form-control" required>
                        </div>
                    </div>

                    <!-- Descripción de la Emergencia -->
                    <div class="mb-3">
                        <label for="descripcion_emergencia" class="form-label">Descripción de la Emergencia:</label>
                        <textarea name="descripcion_emergencia" id="descripcion_emergencia" rows="3" class="form-control" required></textarea>
                    </div>

                    <!-- Tipo de Emergencia -->
                    <div class="mb-3">
                        <label for="tipo_emergencia" class="form-label">Tipo de Emergencia:</label>
                        <select name="tipo_emergencia" id="tipo_emergencia" class="form-select" required>
                            <option value="">Selecciona el tipo de emergencia</option>
                            <option value="Medica">Médica</option>
                            <option value="Seguridad">Seguridad</option>
                            <option value="Ambiental">Ambiental</option>
                            <option value="estructural">Estructural</option>
                        </select>
                    </div>

                    <!-- Evidencias -->
                    <div class="mb-3">
                        <label for="evidencias" class="form-label">Subir Evidencias (imagen):</label>
                        <input type="file" name="evidencias" id="evidencias" class="form-control" accept="image/*">
                    </div>

                    <!-- Creado por (autenticado) -->
                    <input type="hidden" name="creado_por" value="{{ auth()->user()->name }}">

                    <!-- Botón -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-save"></i> Registrar Emergencia
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('emergenciaForm').addEventListener('submit', function(event) {
            event.preventDefault();

            Swal.fire({
                title: '¡Emergencia registrada con éxito!',
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