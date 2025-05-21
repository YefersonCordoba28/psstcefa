@extends('instructor.dashboard')

@section('content')
<div class="container py-4">
    <div class="card shadow border-0">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Registrar Emergencia</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <form action="{{ route('emergencias.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Fecha y hora --}}
                <div class="mb-4">
                    <label for="fecha_hora" class="form-label fw-semibold">
                        <i class="fas fa-calendar-alt me-1"></i>Fecha y Hora de Emergencia
                    </label>
                    <input type="datetime-local" name="fecha_hora" class="form-control" value="{{ old('fecha_hora') }}" required>
                </div>

                {{-- Área y Tipo de Emergencia --}}
                <div class="row g-3">
                    <div class="col-12 col-md-6">
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
                    <div class="col-12 col-md-6">
                        <label for="tipo_emergencia_id" class="form-label fw-semibold">
                            <i class="fas fa-bell me-1"></i>Tipo de Emergencia
                        </label>
                        <select name="tipo_emergencia_id" class="form-select" required>
                            <option value="">Seleccione una opción</option>
                            @foreach($tiposEmergencia as $tipoEmergencia)
                                <option value="{{ $tipoEmergencia->id }}" {{ old('tipo_emergencia_id') == $tipoEmergencia->id ? 'selected' : '' }}>
                                    {{ $tipoEmergencia->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Riesgo --}}
                <div class="row g-3 mt-3">
                    <div class="col-12 col-md-6">
                        <label for="tipo_riesgo_id" class="form-label fw-semibold">
                            <i class="fas fa-exclamation-triangle me-1"></i>Tipo de Riesgo
                        </label>
                        <select name="tipo_riesgo_id" class="form-select" required>
                            <option value="">Seleccione una opción</option>
                            @foreach($tiposRiesgo as $tipoRiesgo)
                                <option value="{{ $tipoRiesgo->id }}" {{ old('tipo_riesgo_id') == $tipoRiesgo->id ? 'selected' : '' }}>
                                    {{ $tipoRiesgo->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Descripción --}}
                <div class="mt-4">
                    <label for="descripcion" class="form-label fw-semibold">
                        <i class="fas fa-align-left me-1"></i>Descripción
                    </label>
                    <textarea name="descripcion" class="form-control" rows="3" placeholder="Describa la emergencia...">{{ old('descripcion') }}</textarea>
                </div>

                {{-- Evidencia (ahora para subir imágenes) --}}
                <div class="mt-4">
                    <label for="evidencia" class="form-label fw-semibold">
                        <i class="fas fa-image me-1"></i>Evidencia (Imagen)
                    </label>
                    <input type="file" class="form-control" id="evidencia" name="evidencia" accept="image/*">
                    <small class="text-muted">Formatos aceptados: JPEG, PNG, JPG, GIF. Tamaño máximo: 2MB</small>
                    @error('evidencia')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Gravedad y Creado por --}}
                <div class="row g-3 mt-3">
                    <div class="col-12 col-md-6">
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
                    <div class="col-12 col-md-6">
                        <label for="creado_por" class="form-label fw-semibold">
                            <i class="fas fa-user-edit me-1"></i>Creado por
                        </label>
                        <input type="text" name="creado_por" class="form-control" value="{{ old('creado_por') }}" required>
                    </div>
                </div>

                {{-- Botón de enviar --}}
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-dark px-4">
                        <i class="fas fa-save me-2"></i>Registrar Emergencia
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection