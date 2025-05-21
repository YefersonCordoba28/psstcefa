@extends('instructor/dashboard')

@section('tituloPagina', 'Registro de Incidente')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg" style="max-width: 600px; margin: auto;">
            <div class="card-header bg-primary text-white text-center">
                <h4>Registrar Incidente</h4>
            </div>
            <div class="card-body bg-light p-4">
                <form id="incidenteForm" action="{{ route('incidentes.store') }}" method="POST" enctype="multipart/form-data">
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

                    <!-- Descripción del Incidente -->
                    <div class="mb-3">
                        <label for="descripcion_incidente" class="form-label">Descripción del Incidente:</label>
                        <textarea name="descripcion_incidente" id="descripcion_incidente" rows="3" class="form-control" required></textarea>
                    </div>

                    <!-- Riesgo -->
                    <div class="mb-3">
                        <label for="riesgo" class="form-label">Riesgo:</label>
                        <select name="riesgo" id="riesgo" class="form-select" required>
                            <option value="">Selecciona el nivel de riesgo</option>
                            <option value="Bajo">Bajo</option>
                            <option value="Moderado">Moderado</option>
                            <option value="Alto">Alto</option>
                        </select>
                    </div>

                    <!-- Estado -->
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado:</label>
                        <select name="estado" id="estado" class="form-select" required>
                            <option value="pendiente">Pendiente</option>
                            <option value="en investigacion">En Investigación</option>
                            <option value="finalizado">Finalizado</option>
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
                            <i class="bi bi-save"></i> Registrar Incidente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('incidenteForm').addEventListener('submit', function(event) {
            event.preventDefault();

            Swal.fire({
                title: '¡Incidente registrado con éxito!',
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