@extends('instructor.dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <!-- Aquí puedes agregar contenido de encabezado si es necesario -->
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white flex-wrap">
                        <h5 class="card-title m-0"><i class="fas fa-exclamation-circle me-2"></i>Registrar Acto Inseguro</h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('actos_inseguros.index') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-list me-1"></i>Ver Todos
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @if(session('success'))
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                <div>{{ session('success') }}</div>
                            </div>
                        @endif

                        <form action="{{ route('actos_inseguros.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-4">
                                <!-- Fecha y Hora -->
                                <div class="col-md-6">
                                    <label for="fecha_hora" class="form-label fw-semibold">
                                        <i class="fas fa-calendar-alt me-1"></i>Fecha y Hora
                                    </label>
                                    <input type="datetime-local" name="fecha_hora" class="form-control" value="{{ old('fecha_hora') }}" required>
                                </div>

                                <!-- Área/Unidad Productiva -->
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

                                <!-- Tipo de Acto Inseguro -->
                                <div class="col-md-4">
                                    <label for="tipo_acto_inseguro_id" class="form-label fw-semibold">
                                        <i class="fas fa-exclamation-circle me-1"></i>Tipo de Acto Inseguro
                                    </label>
                                    <select name="tipo_acto_inseguro_id" class="form-select" required>
                                        <option value="">Seleccione una opción</option>
                                        @foreach($in as $tipo)
                                            <option value="{{ $tipo->id }}" {{ old('tipo_acto_inseguro_id') == $tipo->id ? 'selected' : '' }}>
                                                {{ $tipo->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tipo de Riesgo -->
                                <div class="col-md-4">
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

                                <!-- Gravedad -->
                                <div class="col-md-4">
                                    <label for="gravedad" class="form-label fw-semibold">
                                        <i class="fas fa-thermometer-half me-1"></i>Gravedad
                                    </label>
                                    <select name="gravedad" class="form-select" required>
                                        <option value="">Seleccione la gravedad</option>
                                        <option value="leve" {{ old('gravedad') == 'leve' ? 'selected' : '' }}>Leve</option>
                                        <option value="moderada" {{ old('gravedad') == 'moderada' ? 'selected' : '' }}>Moderada</option>
                                        <option value="grave" {{ old('gravedad') == 'grave' ? 'selected' : '' }}>Grave</option>
                                    </select>
                                </div>

                                <!-- Descripción -->
                                <div class="col-12">
                                    <label for="descripcion" class="form-label fw-semibold">
                                        <i class="fas fa-align-left me-1"></i>Descripción
                                    </label>
                                    <textarea name="descripcion" class="form-control" rows="3" placeholder="Describa el acto inseguro..." required>{{ old('descripcion') }}</textarea>
                                </div>

                                <!-- Evidencia -->
                                <div class="col-12">
                                    <label for="evidencia" class="form-label fw-semibold">
                                        <i class="fas fa-image me-1"></i>Evidencia (Imagen)
                                    </label>
                                    <input type="file" class="form-control" id="evidencia" name="evidencia" accept="image/*">
                                    <small class="text-muted">Formatos aceptados: JPEG, PNG, JPG, GIF. Tamaño máximo: 2MB</small>
                                    @error('evidencia')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Botón de enviar -->
                                <div class="col-12 text-end mt-3">
                                    <button type="submit" class="btn btn-dark px-4">
                                        <i class="fas fa-save me-2"></i>Registrar Acto Inseguro
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }
    .card-header {
        border-bottom: none;
    }
    .card {
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
</style>

@endsection