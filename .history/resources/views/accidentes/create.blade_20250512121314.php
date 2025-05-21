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

            <form action="{{ route('accidentes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    <!-- Fecha y Hora -->
                    <div class="col-md-6">
                        <label for="fecha_hora" class="form-label fw-semibold">
                            <i class="fas fa-calendar-alt me-1"></i>Fecha y Hora <span class="text-danger">*</span>
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
                            <i class="fas fa-thermometer-half me-1"></i>Gravedad <span class="text-danger">*</span>
                        </label>
                        <select name="gravedad" class="form-select @error('gravedad') is-invalid @enderror" required>
                            <option value="">Seleccione...</option>
                            <option value="leve" {{ old('gravedad') == 'leve' ? 'selected' : '' }}>Leve</option>
                            <option value="moderada" {{ old('gravedad') == 'moderada' ? 'selected' : '' }}>Moderada</option>
                            <option value="grave" {{ old('gravedad') == 'grave' ? 'selected' : '' }}>Grave</option>
                            <option value="fatal" {{ old('gravedad') == 'fatal' ? 'selected' : '' }}>Fatal</option>
                        </select>
                        @error('gravedad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Área/Unidad Productiva -->
                    <div class="col-md-6">
                        <label for="area_unidad_productiva_id" class="form-label fw-semibold">
                            <i class="fas fa-industry me-1"></i>Área/Unidad <span class="text-danger">*</span>
                        </label>
                        <select name="area_unidad_productiva_id" class="form-select @error('area_unidad_productiva_id') is-invalid @enderror" required>
                            <option value="">Seleccione...</option>
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
                            <i class="fas fa-hand-holding-medical me-1"></i>Tipo de Lesión <span class="text-danger">*</span>
                        </label>
                        <select name="tipo_lesion_id" class="form-select @error('tipo_lesion_id') is-invalid @enderror" required>
                            <option value="">Seleccione...</option>
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

                    <!-- Tipo de Riesgo -->
                    <div class="col-md-6">
                        <label for="tipo_riesgo_id" class="form-label fw-semibold">
                            <i class="fas fa-exclamation-triangle me-1"></i>Tipo de Riesgo <span class="text-danger">*</span>
                        </label>
                        <select name="tipo_riesgo_id" class="form-select @error('tipo_riesgo_id') is-invalid @enderror" required>
                            <option value="">Seleccione...</option>
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
                            <i class="fas fa-ambulance me-1"></i>Tipo de Accidente <span class="text-danger">*</span>
                        </label>
                        <select name="tipo_accidente_id" class="form-select @error('tipo_accidente_id') is-invalid @enderror" required>
                            <option value="">Seleccione...</option>
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

                    <!-- Descripción -->
                    <div class="col-12">
                        <label for="descripcion" class="form-label fw-semibold">
                            <i class="fas fa-align-left me-1"></i>Descripción <span class="text-danger">*</span>
                        </label>
                        <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" 
                                  rows="3" required>{{ old('descripcion') }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Evidencia -->
                    <div class="col-md-6">
                        <label for="evidencia" class="form-label fw-semibold">
                            <i class="fas fa-image me-1"></i>Evidencia
                        </label>
                        <input type="file" class="form-control @error('evidencia') is-invalid @enderror" 
                               name="evidencia" accept="image/*">
                        <small class="text-muted">Formatos: JPEG, PNG, JPG (Max 2MB)</small>
                        @error('evidencia')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Creado por -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            <i class="fas fa-user me-1"></i>Reportado por
                        </label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="fas fa-eraser me-2"></i> Limpiar
                    </button>
                    <div>
                        <a href="{{ route('accidentes.index') }}" class="btn btn-outline-primary me-2">
                            <i class="fas fa-list me-2"></i> Ver Lista
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-2"></i> Registrar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
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