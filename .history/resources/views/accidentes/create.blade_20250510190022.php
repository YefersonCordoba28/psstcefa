@extends('instructor.dashboard')

@section('content')
<div class="container py-4">
    <div class="card shadow border-0">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Registrar Accidente</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

           <form action="{{ route('accidentes.store') }}" method="POST">
                @csrf

                {{-- Fecha y hora --}}
                <div class="mb-4">
                    <label for="fecha_hora" class="form-label fw-semibold">
                        <i class="fas fa-calendar-alt me-1"></i>Fecha y Hora del Accidente
                    </label>
                    <input type="datetime-local" name="fecha_hora" class="form-control" value="{{ old('fecha_hora') }}" required>
                </div>

                {{-- Área y Lesión --}}
                <div class="row g-3">
                    <div class="col-12 col-md-6">
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
                    <div class="col-12 col-md-6">
                        <label for="tipo_lesion_id" class="form-label fw-semibold">
                            <i class="fas fa-hand-holding-medical me-1"></i>Tipo de Lesión
                        </label>
                        <select name="tipo_lesion_id" class="form-select" required>
                            <option value="">Seleccione una opción</option>
                            @foreach($tiposLesiones as $lesion)
                                <option value="{{ $lesion->id }}">{{ $lesion->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Riesgo y Accidente --}}
                <div class="row g-3 mt-3">
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
                        <label for="tipo_accidente_id" class="form-label fw-semibold">
                            <i class="fas fa-ambulance me-1"></i>Tipo de Accidente
                        </label>
                        <select name="tipo_accidente_id" class="form-select" required>
                            <option value="">Seleccione una opción</option>
                            @foreach($tiposAccidentes as $accidente)
                                <option value="{{ $accidente->id }}">{{ $accidente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Descripción --}}
                <div class="mt-4">
                    <label for="descripcion" class="form-label fw-semibold">
                        <i class="fas fa-align-left me-1"></i>Descripción
                    </label>
                    <textarea name="descripcion" class="form-control" rows="3" placeholder="Describa el accidente...">{{ old('descripcion') }}</textarea>
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
                            <option value="">Seleccione la gravedad</option>
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

                {{-- Botones --}}
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('accidentes.index') }}" class="btn btn-primary">
                        <i class="fas fa-list me-2"></i> Ver Lista de Accidentes
                    </a>
                    <button type="submit" class="btn btn-success px-7">
                        <i class="fas fa-save me-2"></i> Registrar Accidente
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection