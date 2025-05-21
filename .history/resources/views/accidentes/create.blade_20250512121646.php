@extends('instructor.dashboard')

@section('content')
<div class="container py-4">
    <div class="card shadow border-0">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Registrar Accidente</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('accidentes.store') }}" method="POST" enctype="multipart/form-data" id="accidenteForm">
                @csrf

                <!-- Fecha y Hora -->
                <div class="mb-3">
                    <label for="fecha_hora" class="form-label fw-semibold">
                        <i class="fas fa-calendar-alt me-1"></i>Fecha y Hora del Accidente
                    </label>
                    <input type="datetime-local" name="fecha_hora" class="form-control" 
                           value="{{ old('fecha_hora') }}" required>
                </div>

                <!-- Área y Lesión -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="area_unidad_productiva_id" class="form-label fw-semibold">
                            <i class="fas fa-industry me-1"></i>Área o Unidad Productiva
                        </label>
                        <select name="area_unidad_productiva_id" class="form-select" required>
                            <option value="">Seleccione una opción</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}" {{ old('area_unidad_productiva_id') == $area->id ? 'selected' : '' }}>
                                    {{ $area->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="tipo_lesion_id" class="form-label fw-semibold">
                            <i class="fas fa-hand-holding-medical me-1"></i>Tipo de Lesión
                        </label>
                        <select name="tipo_lesion_id" class="form-select" required>
                            <option value="">Seleccione una opción</option>
                            @foreach($tiposLesiones as $lesion)
                                <option value="{{ $lesion->id }}" {{ old('tipo_lesion_id') == $lesion->id ? 'selected' : '' }}>
                                    {{ $lesion->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Riesgo y Accidente -->
                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label for="tipo_riesgo_id" class="form-label fw-semibold">
                            <i class="fas fa-exclamation-triangle me-1"></i>Tipo de Riesgo
                        </label>
                        <select name="tipo_riesgo_id" class="form-select" required>
                            <option value="">Seleccione una opción</option>
                            @foreach($tiposRiesgos as $riesgo)
                                <option value="{{ $riesgo->id }}" {{ old('tipo_riesgo_id') == $riesgo->id ? 'selected' : '' }}>
                                    {{ $riesgo->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="tipo_accidente_id" class="form-label fw-semibold">
                            <i class="fas fa-ambulance me-1"></i>Tipo de Accidente
                        </label>
                        <select name="tipo_accidente_id" class="form-select" required>
                            <option value="">Seleccione una opción</option>
                            @foreach($tiposAccidentes as $accidente)
                                <option value="{{ $accidente->id }}" {{ old('tipo_accidente_id') == $accidente->id ? 'selected' : '' }}>
                                    {{ $accidente->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="mt-3">
                    <label for="descripcion" class="form-label fw-semibold">
                        <i class="fas fa-align-left me-1"></i>Descripción
                    </label>
                    <textarea name="descripcion" class="form-control" rows="3" placeholder="Describa el accidente...">{{ old('descripcion') }}</textarea>
                </div>

                <!-- Evidencia -->
                <div class="mt-3">
                    <label for="evidencia" class="form-label fw-semibold">
                        <i class="fas fa-image me-1"></i>Evidencia (Imagen)
                    </label>
                    <input type="file" class="form-control" name="evidencia" accept="image/*">
                    <small class="text-muted">Formatos aceptados: JPEG, PNG, JPG. Tamaño máximo: 2MB</small>
                </div>

                <!-- Gravedad y Creado por -->
                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label for="gravedad" class="form-label fw-semibold">
                            <i class="fas fa-thermometer-half me-1"></i>Gravedad
                        </label>
                        <select name="gravedad" class="form-select" required>
                            <option value="">Seleccione la gravedad</option>
                            <option value="leve" {{ old('gravedad') == 'leve' ? 'selected' : '' }}>Leve</option>
                            <option value="moderada" {{ old('gravedad') == 'moderada' ? 'selected' : '' }}>Moderada</option>
                            <option value="grave" {{ old('gravedad') == 'grave' ? 'selected' : '' }}>Grave</option>
                            <option value="fatal" {{ old('gravedad') == 'fatal' ? 'selected' : '' }}>Fatal</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-user-edit me-1"></i>Creado por
                        </label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                        <input type="hidden" name="creado_por" value="{{ auth()->user()->name }}">
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-2"></i> Registrar Accidente
                    </button>
                    <a href="{{ route('accidentes.index') }}" class="btn btn-primary">
                        <i class="fas fa-list me-2"></i> Ver Lista de Accidentes
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Validación básica del formulario
    document.getElementById('accidenteForm').addEventListener('submit', function(e) {
        let isValid = true;
        
        // Validar campos requeridos
        const requiredFields = this.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });

        // Validar archivo de imagen si se subió
        const fileInput = this.querySelector('input[type="file"]');
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            
            if (!validTypes.includes(file.type)) {
                isValid = false;
                alert('Por favor, suba una imagen válida (JPEG, PNG, JPG)');
            }
            
            if (file.size > 2 * 1024 * 1024) { // 2MB
                isValid = false;
                alert('El tamaño de la imagen no debe exceder los 2MB');
            }
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
</script>

<style>
    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #dc3545;
    }
    .card-header {
        border-radius: 0.375rem 0.375rem 0 0 !important;
    }
    .btn-success {
        background-color: #198754;
        border-color: #198754;
    }
    .btn-success:hover {
        background-color: #157347;
        border-color: #146c43;
    }
</style>
@endsection