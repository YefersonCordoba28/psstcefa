@extends('instructor/dashboard')

@section('tituloPagina', 'Registro de Evento')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg" style="max-width: 600px; margin: auto;">
            <div class="card-header bg-primary text-white text-center">
                <h4>Registrar Evento</h4>
            </div>
            <div class="card-body bg-light p-4">
                <form id="eventoForm" action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Fecha -->
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar-date"></i></span>
                            <input type="date" name="fecha" id="fecha" class="form-control" required>
                        </div>
                    </div>

                    <!-- Hora -->
                    <div class="mb-3">
                        <label for="hora" class="form-label">Hora:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-clock"></i></span>
                            <input type="time" name="hora" id="hora" class="form-control" required>
                        </div>
                    </div>

                    <!-- Ubicación -->
                    <div class="mb-3">
                        <label for="ubicación" class="form-label">Ubicación:</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" name="ubicación" id="ubicación" class="form-control" required>
                        </div>
                    </div>

                    <!-- Tipo de Evento -->
                    <div class="mb-3">
                        <label for="tipo_evento" class="form-label">Tipo de Evento:</label>
                        <select name="tipo_evento" id="tipo_evento" class="form-select" required>
                            <option value="">Selecciona un tipo</option>
                            <option value="Accidente">Accidente</option>
                            <option value="Incidente">Incidente</option>
                            <option value="Emergencia">Emergencia</option>
                        </select>
                    </div>

                    <!-- Descripción del Evento -->
                    <div class="mb-3">
                        <label for="descripción_evento" class="form-label">Descripción del Evento:</label>
                        <textarea name="descripción_evento" id="descripción_evento" rows="3" class="form-control" required></textarea>
                    </div>

                    <!-- Personas Involucradas -->
                    <div class="mb-3">
                        <label for="personas_involucradas" class="form-label">Personas Involucradas:</label>
                        <textarea name="personas_involucradas" id="personas_involucradas" rows="2" class="form-control"></textarea>
                    </div>

                    <!-- Testigos -->
                    <div class="mb-3">
                        <label for="testigos" class="form-label">Testigos:</label>
                        <textarea name="testigos" id="testigos" rows="2" class="form-control"></textarea>
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
                            <i class="bi bi-save"></i> Registrar Evento
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('eventoForm').addEventListener('submit', function(event) {
            event.preventDefault();

            Swal.fire({
                title: '¡Evento registrado con éxito!',
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
