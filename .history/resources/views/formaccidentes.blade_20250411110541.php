@extends('instructor/dashboard')

@section('tituloPagina', 'Registro de Accidente')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0" style="max-width: 700px; margin: auto;">
        <div class="card-header bg-primary text-white text-center py-3 rounded-top">
            <h4 class="mb-0"><i class="bi bi-clipboard-plus me-2"></i>Registrar Accidente</h4>
        </div>
        <div class="card-body bg-light p-4">
            <form id="accidenteForm" action="{{ route('accidentes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Fecha y Hora -->
                <div class="mb-3">
                    <label for="fecha_hora" class="form-label">Fecha y Hora:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar-event-fill"></i></span>
                        <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control" required>
                    </div>
                </div>

                <!-- Ubicación -->
                <div class="mb-3">
                    <label for="ubicacion" class="form-label">Ubicación del incidente:</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
                        <input type="text" name="ubicacion" id="ubicacion" class="form-control" required>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="mb-3">
                    <label for="descripcion_accidente" class="form-label">Descripción del Accidente:</label>
                    <textarea name="descripcion_accidente" id="descripcion_accidente" class="form-control" rows="3" required></textarea>
                </div>

                <!-- Personas Involucradas -->
                <div class="mb-3">
                    <label for="personas_involucradas" class="form-label">Personas Involucradas:</label>
                    <textarea name="personas_involucradas" id="personas_involucradas" class="form-control" rows="2"></textarea>
                </div>

                <!-- Gravedad -->
                <div class="mb-3">
                    <label for="gravedad" class="form-label">Nivel de Gravedad:</label>
                    <select name="gravedad" id="gravedad" class="form-select" required>
                        <option value="">Selecciona la gravedad</option>
                        <option value="Leve">Leve</option>
                        <option value="Moderado">Moderado</option>
                        <option value="Grave">Grave</option>
                    </select>
                </div>

                <!-- Evidencias -->
                <div class="mb-3">
                    <label for="evidencias" class="form-label">Subir Evidencia (imagen):</label>
                    <input type="file" name="evidencias" id="evidencias" class="form-control" accept="image/*" onchange="previewImage(event)">
                    <div class="mt-3" id="imagePreview" style="display: none;">
                        <img id="preview" src="#" alt="Vista previa" class="img-fluid rounded shadow">
                    </div>
                </div>

                <!-- Oculto: Creado por -->
                <input type="hidden" name="creado_por" value="{{ auth()->user()->name }}">

                <!-- Botón -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-lg px-5">
                        <i class="bi bi-save me-2"></i>Registrar
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
            title: '¿Confirmar registro?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, registrar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        });
    });

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('preview');
            output.src = reader.result;
            document.getElementById('imagePreview').style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
