@extends('instructor.dashboard')

@section('content')
<div class="container py-4">
    <div class="card shadow border-0">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-fire me-2"></i>Registrar Emergencia</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <form action="{{ route('emergencias.store') }}" method="POST">
                @csrf

                {{-- Fecha y hora --}}
                <div class="mb-4">
                    <label for="fecha_hora" class="form-label fw-semibold">
                        <i class="fas fa-calendar-alt me-1"></i>Fecha y Hora de la Emergencia
                    </label>
                    <input type="datetime-local" name="fecha_hora" class="form-control" value="{{ old('fecha_hora') }}" required>
                </div>

                {{-- Área o Unidad Productiva --}}
                <div class="mb-4">
                    <label for="area_unidad_productiva_id" class="form-label fw-semibold">
                        <i class="fas fa-industry me-1"></i>Área o Unidad Productiva
                    </label>
                    <select name="area_unidad_productiva_id" class="form-select" required>
                        <option value="">Seleccione una opción</option>
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Tipo de Riesgo y Tipo de Emergencia --}}
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label for="tipo_riesgo_id" class="form-label fw-semibold">
                            <i class="fas fa-exclamation-triangle me-1"></i>Tipo de Riesgo
                        </label>
                        <select name="tipo_riesgo_id" class="form-select" required>
                            <option value="">Seleccione una opción</option>
                            @foreach($tiposRiesgos as $riesgo)
                                <option value="{{ $riesgo->id }}">{{ $riesgo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="tipo_emergencia_id" class="form-label fw-semibold">
                            <i class="fas fa-bolt me-1"></i>Tipo de Emergencia
                        </label>
                        <select name="tipo_emergencia_id" class="form-select" required>
                            <option value="">Seleccione una opción</option>
                            @foreach($tiposEmergencias as $emergencia)
                                <option value="{{ $emergencia->id }}">{{ $emergencia->nombre }}</option>
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

                {{-- Evidencia --}}
                <div class="mt-4">
                    <label for="evidencia" class="form-label fw-semibold">
                        <i class="fas fa-paperclip me-1"></i>Evidencia
                    </label>
                    <textarea name="evidencia" class="form-control" rows="2" placeholder="Detalles de la evidencia...">{{ old('evidencia') }}</textarea>
                </div>

                {{-- Gravedad y Creado por --}}
                <div class="row g-3 mt-3">
                    <div class="col-12 col-md-6">
                        <label for="gravedad" class="form-label fw-semibold">
                            <i class="fas fa-thermometer-half me-1"></i>Gravedad
                        </label>
                        <select name="gravedad" class="form-select" required>
                            <option value="">Seleccione el nivel</option>
                            <option value="leve">Leve</option>
                            <option value="moderada">Moderada</option>
                            <option value="grave">Grave</option>
                            <option value="fatal">Fatal</option>
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
