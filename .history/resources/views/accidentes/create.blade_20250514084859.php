@extends('instructor.dashboard')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-gradient-primary text-white py-3">
            <div class="d-flex align-items-center">
                <div class="rounded-circle bg-white p-2 me-3">
                    <i class="fas fa-clipboard-check text-primary"></i>
                </div>
                <h4 class="mb-0 fw-bold">Registro de Accidentes</h4>
            </div>
        </div>
        
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-start border-success border-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('accidentes.store') }}" method="POST" enctype="multipart/form-data" id="accidenteForm">
                @csrf
                
                <div class="row">
                    <!-- Columna Izquierda -->
                    <div class="col-lg-7">
                        <div class="p-3 bg-light rounded-3 mb-4">
                            <h5 class="border-bottom border-2 pb-2 mb-3 text-primary">
                                <i class="fas fa-info-circle me-2"></i>Información del Incidente
                            </h5>

                            <!-- Fecha, Hora y Ubicación -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="datetime-local" name="fecha_hora" class="form-control" id="fecha_hora" 
                                               value="{{ old('fecha_hora') }}" required>
                                        <label for="fecha_hora"><i class="fas fa-calendar-alt me-1"></i>Fecha y Hora</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="area_unidad_productiva_id" class="form-select" id="area_unidad_productiva_id" required>
                                            <option value="">Seleccione una opción</option>
                                            @foreach($areas as $area)
                                                <option value="{{ $area->id }}" {{ old('area_unidad_productiva_id') == $area->id ? 'selected' : '' }}>
                                                    {{ $area->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="area_unidad_productiva_id"><i class="fas fa-industry me-1"></i>Área/Unidad</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Tipo de Accidente y Riesgo -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="tipo_accidente_id" class="form-select" id="tipo_accidente_id" required>
                                            <option value="">Seleccione una opción</option>
                                            @foreach($tiposAccidentes as $accidente)
                                                <option value="{{ $accidente->id }}" {{ old('tipo_accidente_id') == $accidente->id ? 'selected' : '' }}>
                                                    {{ $accidente->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="tipo_accidente_id"><i class="fas fa-ambulance me-1"></i>Tipo de Accidente</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="tipo_riesgo_id" class="form-select" id="tipo_riesgo_id" required>
                                            <option value="">Seleccione una opción</option>
                                            @foreach($tiposRiesgos as $riesgo)
                                                <option value="{{ $riesgo->id }}" {{ old('tipo_riesgo_id') == $riesgo->id ? 'selected' : '' }}>
                                                    {{ $riesgo->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="tipo_riesgo_id"><i class="fas fa-exclamation-triangle me-1"></i>Tipo de Riesgo</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Descripción -->
                            <div class="form-floating mb-3">
                                <textarea name="descripcion" class="form-control" id="descripcion" style="height: 120px" placeholder="Describa el accidente...">{{ old('descripcion') }}</textarea>
                                <label for="descripcion"><i class="fas fa-align-left me-1"></i>Descripción del Incidente</label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Columna Derecha -->
                    <div class="col-lg-5">
                        <div class="p-3 bg-light rounded-3 mb-4">
                            <h5 class="border-bottom border-2 pb-2 mb-3 text-primary">
                                <i class="fas fa-hand-holding-medical me-2"></i>Evaluación de Daños
                            </h5>

                            <!-- Tipo de Lesión -->
                            <div class="form-floating mb-3">
                                <select name="tipo_lesion_id" class="form-select" id="tipo_lesion_id" required>
                                    <option value="">Seleccione una opción</option>
                                    @foreach($tiposLesiones as $lesion)
                                        <option value="{{ $lesion->id }}" {{ old('tipo_lesion_id') == $lesion->id ? 'selected' : '' }}>
                                            {{ $lesion->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="tipo_lesion_id"><i class="fas fa-band-aid me-1"></i>Tipo de Lesión</label>
                            </div>

                            <!-- Gravedad -->
                            <div class="form-floating mb-3">
                                <select name="gravedad" class="form-select" id="gravedad" required>
                                    <option value="">Seleccione la gravedad</option>
                                    <option value="leve" {{ old('gravedad') == 'leve' ? 'selected' : '' }}>Leve</option>
                                    <option value="moderada" {{ old('gravedad') == 'moderada' ? 'selected' : '' }}>Moderada</option>
                                    <option value="grave" {{ old('gravedad') == 'grave' ? 'selected' : '' }}>Grave</option>
                                    <option value="fatal" {{ old('gravedad') == 'fatal' ? 'selected' : '' }}>Fatal</option>
                                </select>
                                <label for="gravedad"><i class="fas fa-thermometer-half me-1"></i>Nivel de Gravedad</label>
                            </div>

                            <!-- Evidencia -->
                            <div class="card mb-3 border-dashed">
                                <div class="card-body text-center p-3">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-primary mb-3"></i>
                                    <h6 class="fw-bold">Evidencia Fotográfica</h6>
                
                                    <input type="file" class="form-control" name="evidencia" id="evidencia" accept="image/*">
                                    <small class="d-block text-muted mt-2">Formatos: JPEG, PNG, JPG. Máx: 2MB</small>
                                </div>
                            </div>
                            
                            <!-- Creado por -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                                <input type="hidden" name="creado_por" value="{{ auth()->user()->name }}">
                                <label><i class="fas fa-user-edit me-1"></i>Reportado por</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5 py-2 d-flex align-items-center">
                        <i class="fas fa-save me-2"></i> Registrar Incidente
                    </button>
                    <a href="{{ route('accidentes.index') }}" class="btn btn-outline-secondary d-flex align-items-center">
                        <i class="fas fa-list me-2"></i> Ver Historial de Incidentes
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
                
                // Crear mensaje de error
                if (!field.nextElementSibling || !field.nextElementSibling.classList.contains('invalid-feedback')) {
                    const feedback = document.createElement('div');
                    feedback.classList.add('invalid-feedback');
                    feedback.innerText = 'Este campo es obligatorio';
                    field.parentNode.appendChild(feedback);
                }
            } else {
                field.classList.remove('is-invalid');
                // Eliminar mensajes de error si existen
                const nextSibling = field.nextElementSibling;
                if (nextSibling && nextSibling.classList.contains('invalid-feedback')) {
                    nextSibling.remove();
                }
            }
        });

        // Validar archivo de imagen si se subió
        const fileInput = this.querySelector('input[type="file"]');
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            
            if (!validTypes.includes(file.type)) {
                isValid = false;
                fileInput.classList.add('is-invalid');
                
                // Mostrar alerta estilizada en lugar de alert()
                showCustomAlert('Por favor, suba una imagen válida (JPEG, PNG, JPG)');
            }
            
            if (file.size > 2 * 1024 * 1024) { // 2MB
                isValid = false;
                fileInput.classList.add('is-invalid');
                
                // Mostrar alerta estilizada en lugar de alert()
                showCustomAlert('El tamaño de la imagen no debe exceder los 2MB');
            }
        }

        if (!isValid) {
            e.preventDefault();
        }
    });
    
    // Función para mostrar alertas personalizadas
    function showCustomAlert(message) {
        // Crear alerta
        const alertDiv = document.createElement('div');
        alertDiv.classList.add('alert', 'alert-danger', 'alert-dismissible', 'fade', 'show', 'my-3', 'animate__animated', 'animate__fadeIn');
        alertDiv.setAttribute('role', 'alert');
        
        // Contenido de la alerta
        alertDiv.innerHTML = `
            <i class="fas fa-exclamation-circle me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        
        // Insertar antes del botón submit
        const form = document.getElementById('accidenteForm');
        form.insertBefore(alertDiv, form.querySelector('.d-flex.justify-content-between'));
        
        // Auto-eliminar después de 5 segundos
        setTimeout(() => {
            alertDiv.classList.add('animate__fadeOut');
            setTimeout(() => alertDiv.remove(), 1000);
        }, 5000);
    }
    
    // Previsualizar imagen al seleccionarla
    document.getElementById('evidencia').addEventListener('change', function(e) {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Crear o actualizar la previsualización
                let preview = document.getElementById('imagePreview');
                if (!preview) {
                    preview = document.createElement('div');
                    preview.id = 'imagePreview';
                    preview.classList.add('mt-3', 'text-center');
                    
                    const cardBody = document.querySelector('.card-body.text-center');
                    cardBody.appendChild(preview);
                }
                
                preview.innerHTML = `
                    <div class="position-relative">
                        <img src="${e.target.result}" class="img-thumbnail" style="max-height: 150px;">
                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle" 
                                onclick="removeImage()" style="margin-top: -10px; margin-right: -10px;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                
                // Ocultar elementos de upload
                document.querySelector('.fa-cloud-upload-alt').style.display = 'none';
                document.querySelector('.small.text-muted').style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    });
    
    // Función para eliminar imagen seleccionada
    function removeImage() {
        document.getElementById('evidencia').value = '';
        document.getElementById('imagePreview').remove();
        
        // Mostrar elementos de upload nuevamente
        document.querySelector('.fa-cloud-upload-alt').style.display = 'block';
        document.querySelector('.small.text-muted').style.display = 'block';
    }
</script>

<style>
    /* Estilos generales */
    body {
        background-color: #f8f9fc;
    }
    
    /* Degradado para el encabezado */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #2c3e50 0%, #4ca1af 100%);
    }
    
    /* Mejoras en las tarjetas */
    .card {
        transition: all 0.3s ease;
        border-radius: 0.75rem;
    }
    
    .card-header {
        border-radius: 0.75rem 0.75rem 0 0 !important;
    }
    
    /* Estilos para los campos de formulario */
    .form-control, .form-select {
        border-radius: 0.5rem;
        padding: 0.75rem;
        transition: border-color 0.15s ease-in-out;
        border: 1px solid #ced4da;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #4ca1af;
        box-shadow: 0 0 0 0.25rem rgba(76, 161, 175, 0.25);
    }
    
    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #dc3545;
        background-image: none;
    }
    
    /* Estilos para el área de carga de imágenes */
    .border-dashed {
        border: 2px dashed #dee2e6;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .border-dashed:hover {
        border-color: #4ca1af;
    }
    
    /* Estilos para botones */
    .btn-primary {
        background-color: #4ca1af;
        border-color: #4ca1af;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(50, 50, 93, 0.11), 0 1px 3px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background-color: #3a8f9d;
        border-color: #3a8f9d;
        transform: translateY(-1px);
        box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
    }
    
    .btn-outline-secondary {
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }
    
    .btn-outline-secondary:hover {
        transform: translateY(-1px);
    }
    
    /* Animaciones para alertas */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes fadeOut {
        from { opacity: 1; transform: translateY(0); }
        to { opacity: 0; transform: translateY(-10px); }
    }
    
    .animate__animated {
        animation-duration: 0.5s;
    }
    
    .animate__fadeIn {
        animation-name: fadeIn;
    }
    
    .animate__fadeOut {
        animation-name: fadeOut;
    }
    
    /* Estilos para fondos de secciones */
    .bg-light {
        background-color: #f8f9fa!important;
        border-radius: 0.5rem;
    }
    
    /* Estilos para títulos de sección */
    h5.border-bottom {
        border-color: rgba(76, 161, 175, 0.3)!important;
    }
    
    /* Responsive tweaks */
    @media (max-width: 992px) {
        .col-lg-7, .col-lg-5 {
            margin-bottom: 1rem;
        }
    }
</style>
@endsection