@extends('instructor/dashboard')

@section('tituloPagina', 'Registro de Accidente')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg" style="max-width: 600px; margin: auto;">
            <div class="card-header bg-primary text-white text-center">
                <h4>Registrar Accidente</h4>
            </div>
            <div class="card-body bg-light p-4">
                <form id="accidenteForm" action="{{ route('accidentes.store') }}" method="POST" enctype="multipart/form-data">
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

                    <!-- Descripción del Accidente -->
                    <div class="mb-3">
                        <label for="descripcion_accidente" class="form-label">Descripción del Accidente:</label>
                        <textarea name="descripcion_accidente" id="descripcion_accidente" rows="3" class="form-control" required></textarea>
                    </div>

                    <!-- Personas Involucradas -->
                    <div class="mb-3">
                        <label for="personas_involucradas" class="form-label">Personas Involucradas:</label>
                        <textarea name="personas_involucradas" id="personas_involucradas" rows="2" class="form-control"></textarea>
                    </div>

                    <!-- Gravedad -->
                    <div class="mb-3">
                        <label for="gravedad" class="form-label">Gravedad:</label>
                        <select name="gravedad" id="gravedad" class="form-select" required>
                            <option value="">Selecciona la gravedad</option>
                            <option value="Leve">Leve</option>
                            <option value="Moderado">Moderado</option>
                            <option value="Grave">Grave</option>
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
                            <i class="bi bi-save"></i> Registrar Accidente
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