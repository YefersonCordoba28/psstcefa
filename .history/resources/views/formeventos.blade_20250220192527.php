@extends('layouts/master')

@section('tituloPagina', 'Registro de Evento')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-warning text-dark text-center">
            <h4 class="fw-bold">Registrar Evento</h4>
        </div>
        <div class="card-body bg-light">
            <form id="eventoForm" action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <!-- Fecha -->
                    <div class="col-md-6">
                        <label for="fecha" class="form-label fw-semibold">Fecha:</label>
                        <div class="input-group">
                            <span class="input-group-text bg-warning text-dark"><i class="bi bi-calendar-date"></i></span>
                            <input type="date" name="fecha" id="fecha" class="form-control" required>
                        </div>
                    </div>

                    <!-- Hora -->
                    <div class="col-md-6">
                        <label for="hora" class="form-label fw-semibold">Hora:</label>
                        <div class="input-group">
                            <span class="input-group-text bg-warning text-dark"><i class="bi bi-clock"></i></span>
                            <input type="time" name="hora" id="hora" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <!-- Ubicación -->
                    <div class="col-md-12">
                        <label for="ubicación" class="form-label fw-semibold">Ubicación:</label>
                        <div class="input-group">
                            <span class="input-group-text bg-warning text-dark"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" name="ubicación" id="ubicación" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <!-- Tipo de Evento -->
                    <div class="col-md-6">
                        <label for="tipo_evento" class="form-label fw-semibold">Tipo de Evento:</label>
                        <select name="tipo_evento" id="tipo_evento" class="form-select" required>
                            <option value="">Selecciona un tipo</option>
                            <option value="Accidente">Accidente</option>
                            <option value="Incidente">Incidente</option>
                            <option value="Emergencia">Emergencia</option>
                        </select>
                    </div>

                    <!-- Evidencias -->
                    <div class="col-md-6">
                        <label for="evidencias" class="form-label fw-semibold">Subir Evidencias (imagen):</label>
                        <input type="file" name="evidencias" id="evidencias" class="form-control" accept="image/*">
                    </div>
                </div>

                <div class="mt-3">
                    <!-- Descripción del Evento -->
                    <label for="descripción_evento" class="form-label fw-semibold">Descripción del Evento:</label>
                    <textarea name="descripción_evento" id="descripción_evento" rows="4" class="form-control" required></textarea>
                </div>

                <div class="row g-3 mt-3">
                    <!-- Personas Involucradas -->
                    <div class="col-md-6">
                        <label for="personas_involucradas" class="form-label fw-semibold">Personas Involucradas:</label>
                        <textarea name="personas_involucradas" id="personas_involucradas" rows="3" class="form-control"></textarea>
                    </div>

                    <!-- Testigos -->
                    <div class="col-md-6">
                        <label for="testigos" class="form-label fw-semibold">Testigos:</label>
                        <textarea name="testigos" id="testigos" rows="3" class="form-control"></textarea>
                    </div>
                </div>

                <!-- Creado por (autenticado) -->
                <input type="hidden" name="creado_por" value="{{ auth()->user()->name }}">

                <!-- Botón -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
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
            confirmButtonText: 'Aceptar',
            confirmButtonColor: '#3085d6'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });
</script>
@endsection
