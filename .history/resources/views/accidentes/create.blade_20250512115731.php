@extends('instructor.dashboard')

@section('content')
<div class="container py-4">
    <div class="card shadow border-0">
        <div class="card-header bg-gradient-danger text-white">
            <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i>Registrar Reporte de Accidente</h5>
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

                <!-- Sección 1: Información Básica -->
                <div class="mb-4 border-bottom pb-3">
                    <h6 class="text-danger fw-bold mb-3">
                        <i class="fas fa-info-circle me-2"></i>INFORMACIÓN BÁSICA DEL INCIDENTE
                    </h6>
                    
                    <div class="row g-3">
                        <!-- Fecha y hora -->
                        <div class="col-md-6">
                            <label for="fecha_hora" class="form-label fw-semibold">
                                <i class="fas fa-calendar-alt me-1 text-danger"></i>Fecha y Hora del Accidente <span class="text-danger">*</span>
                            </label>
                            <input type="datetime-local" name="fecha_hora" class="form-control @error('fecha_hora') is-invalid @enderror" 
                                   value="{{ old('fecha_hora', now()->format('Y-m-d\TH:i')) }}" required>
                            @error('fecha_hora')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Gravedad -->
                        <div class="col-md-6">
                            <label for="gravedad" class="form-label fw-semibold">
                                <i class="fas fa-thermometer-three-quarters me-1 text-danger"></i>Nivel de Gravedad <span class="text-danger">*</span>
                            </label>
                            <select name="gravedad" class="form-select @error('gravedad') is-invalid @enderror" required>
                                <option value="">Seleccione la gravedad</option>
                                <option value="leve" {{ old('gravedad') == 'leve' ? 'selected' : '' }}>Leve (Primeros auxilios)</option>
                                <option value="moderada" {{ old('gravedad') == 'moderada' ? 'selected' : '' }}>Moderada (Atención médica sin hospitalización)</option>
                                <option value="grave" {{ old('gravedad') == 'grave' ? 'selected' : '' }}>Grave (Hospitalización)</option>
                                <option value="fatal" {{ old('gravedad') == 'fatal' ? 'selected' : '' }}>Fatal (Pérdida de vida)</option>
                            </select>
                            @error('gravedad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Sección 2: Detalles del Accidente -->
                <div class="mb-4 border-bottom pb-3">
                    <h6 class="text-danger fw-bold mb-3">
                        <i class="fas fa-file-medical me-2"></i>DETALLES DEL ACCIDENTE
                    </h6>
                    
                    <div class="row g-3">
                        <!-- Área/Unidad Productiva -->
                        <div class="col-md-6">
                            <label for="area_unidad_productiva_id" class="form-label fw-semibold">
                                <i class="fas fa-map-marker-alt me-1 text-danger"></i>Área/Unidad Productiva <span class="text-danger">*</span>
                            </label>
                            <select name="area_unidad_productiva_id" class="form-select @error('area_unidad_productiva_id') is-invalid @enderror" required>
                                <option value="">Seleccione el área</option>
                                @foreach($areas as $area)
                                    <option value="{{ $area->id }}" {{ old('area_unidad_productiva_id') == $area->id ? 'selected' : '' }}>
                                        {{ $area->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('area_unidad_productiva_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Tipo de Lesión -->
                        <div class="col-md-6">
                            <label for="tipo_lesion_id" class="form-label fw-semibold">
                                <i class="fas fa-bone me-1 text-danger"></i>Tipo de Lesión <span class="text-danger">*</span>
                            </label>
                            <select name="tipo_lesion_id" class="form-select @error('tipo_lesion_id') is-invalid @enderror" required>
                                <option value="">Seleccione el tipo de lesión</option>
                                @foreach($tiposLesiones as $lesion)
                                    <option value="{{ $lesion->id }}" {{ old('tipo_lesion_id') == $lesion->id ? 'selected' : '' }}>
                                        {{ $lesion->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_lesion_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row g-3 mt-3">
                        <!-- Tipo de Riesgo -->
                        <div class="col-md-6">
                            <label for="tipo_riesgo_id" class="form-label fw-semibold">
                                <i class="fas fa-radiation me-1 text-danger"></i>Tipo de Riesgo <span class="text-danger">*</span>
                            </label>
                            <select name="tipo_riesgo_id" class="form-select @error('tipo_riesgo_id') is-invalid @enderror" required>
                                <option value="">Seleccione el tipo de riesgo</option>
                                @foreach($tiposRiesgos as $riesgo)
                                    <option value="{{ $riesgo->id }}" {{ old('tipo_riesgo_id') == $riesgo->id ? 'selected' : '' }}>
                                        {{ $riesgo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_riesgo_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Tipo de Accidente -->
                        <div class="col-md-6">
                            <label for="tipo_accidente_id" class="form-label fw-semibold">
                                <i class="fas fa-car-crash me-1 text-danger"></i>Tipo de Accidente <span class="text-danger">*</span>
                            </label>
                            <select name="tipo_accidente_id" class="form-select @error('tipo_accidente_id') is-invalid @enderror" required>
                                <option value="">Seleccione el tipo de accidente</option>
                                @foreach($tiposAccidentes as $accidente)
                                    <option value="{{ $accidente->id }}" {{ old('tipo_accidente_id') == $accidente->id ? 'selected' : '' }}>
                                        {{ $accidente->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tipo_accidente_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Descripción -->
                    <div class="mt-3">
                        <label for="descripcion" class="form-label fw-semibold">
                            <i class="fas fa-file-alt me-1 text-danger"></i>Descripción Detallada <span class="text-danger">*</span>
                        </label>
                        <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" 
                                  rows="4" placeholder="Describa en detalle cómo ocurrió el accidente, las condiciones del entorno y cualquier otro dato relevante..." required>{{ old('descripcion') }}</textarea>
                        <small class="text-muted">Mínimo 50 caracteres. Incluya personas involucradas, acciones realizadas y consecuencias.</small>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Sección 3: Evidencia -->
                <div class="mb-4 border-bottom pb-3">
                    <h6 class="text-danger fw-bold mb-3">
                        <i class="fas fa-camera me-2"></i>EVIDENCIA DEL ACCIDENTE
                    </h6>
                    
                    <div class="row g-3">
                        <!-- Subida de imágenes -->
                        <div class="col-md-12">
                            <label for="evidencia" class="form-label fw-semibold">
                                <i class="fas fa-images me-1 text-danger"></i>Evidencia Fotográfica
                            </label>
                            <input type="file" class="form-control @error('evidencia') is-invalid @enderror" 
                                   id="evidencia" name="evidencia" accept="image/*,.pdf" onchange="previewImage(this)">
                            <small class="text-muted">Formatos aceptados: JPEG, PNG, JPG, PDF. Tamaño máximo: 5MB</small>
                            @error('evidencia')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <!-- Vista previa de imagen -->
                            <div class="mt-3 text-center" id="imagePreviewContainer" style="display:none;">
                                <img id="imagePreview" src="#" alt="Vista previa de la imagen" 
                                     class="img-thumbnail" style="max-height: 200px;">
                                <button type="button" class="btn btn-sm btn-danger mt-2" 
                                        onclick="removeImage()">
                                    <i class="fas fa-trash me-1"></i> Eliminar
                                </button>
                            </div>
                        </div>
                        
                        <!-- Testigos -->
                        <div class="col-md-12 mt-3">
                            <label for="testigos" class="form-label fw-semibold">
                                <i class="fas fa-users me-1 text-danger"></i>Testigos (opcional)
                            </label>
                            <textarea name="testigos" class="form-control" rows="2" 
                                      placeholder="Nombres y contactos de testigos (si los hubiera)">{{ old('testigos') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Sección 4: Información del Reportante -->
                <div class="mb-4">
                    <h6 class="text-danger fw-bold mb-3">
                        <i class="fas fa-user-shield me-2"></i>INFORMACIÓN DEL REPORTANTE
                    </h6>
                    
                    <div class="row g-3">
                        <!-- Creado por -->
                        <div class="col-md-6">
                            <label for="creado_por" class="form-label fw-semibold">
                                <i class="fas fa-user me-1 text-danger"></i>Reportado por <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="creado_por" class="form-control" 
                                   value="{{ auth()->user()->name }}" readonly required>
                        </div>
                        
                        <!-- Fecha de reporte -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-clock me-1 text-danger"></i>Fecha de Reporte
                            </label>
                            <input type="text" class="form-control" 
                                   value="{{ now()->format('d/m/Y H:i') }}" readonly>
                        </div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">
                        <i class="fas fa-eraser me-2"></i> Limpiar Formulario
                    </button>
                    
                    <div>
                        <a href="{{ route('accidentes.index') }}" class="btn btn-outline-primary me-2">
                            <i class="fas fa-list me-2"></i> Ver Listado
                        </a>
                        <button type="submit" class="btn btn-danger gradient-danger">
                            <i class="fas fa-save me-2"></i> Registrar Accidente
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script para manejar la vista previa de imágenes -->
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const fileType = file.type;
            const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            
            if (validImageTypes.includes(fileType)) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('imagePreviewContainer').style.display = 'block';
                }
                
                reader.readAsDataURL(input.files[0]);
            } else {
                // Si es PDF u otro formato, ocultar la vista previa
                document.getElementById('imagePreviewContainer').style.display = 'none';
            }
        }
    }
    
    function removeImage() {
        document.getElementById('evidencia').value = '';
        document.getElementById('imagePreviewContainer').style.display = 'none';
    }
    
    function resetForm() {
        if(confirm('¿Está seguro que desea limpiar todo el formulario?')) {
            document.getElementById('accidenteForm').reset();
            document.getElementById('imagePreviewContainer').style.display = 'none';
        }
    }
</script>

<style>
    .gradient-danger {
        background: linear-gradient(135deg, #dc3545, #fd7e14);
        border: none;
    }
    .gradient-danger:hover {
        background: linear-gradient(135deg, #c82333, #e36209);
    }
    .card-header {
        border-radius: 0.375rem 0.375rem 0 0 !important;
    }
    .form-control, .form-select {
        border-radius: 0.375rem;
    }
    textarea {
        resize: vertical;
        min-height: 100px;
    }
</style>
@endsection