@extends('instructor.dashboard')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-notes-medical me-2"></i>Registrar Accidente</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-1"></i>{{ session('success') }}
                </div>
            @endif

            <form action="{{ route('accidentes.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="fecha_hora" class="form-label">📅 Fecha y Hora del Accidente</label>
                    <input type="datetime-local" name="fecha_hora" class="form-control" value="{{ old('fecha_hora') }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="area_unidad_productiva_id" class="form-label">🏢 Área o Unidad Productiva</label>
                        <select name="area_unidad_productiva_id" class="form-select" required>
                            <option value="">Seleccione una opción</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tipo_lesion_id" class="form-label">🩹 Tipo de Lesión</label>
                        <select name="tipo_lesion_id" class="form-select" required>
                            <option value="">Seleccione una opción</option>
                            @foreach($tiposLesiones as $lesion)
                                <option value="{{ $lesion->id }}">{{ $lesion->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tipo_riesgo_id" class="form-label">⚠️ Tipo de Riesgo</label>
                        <select name="tipo_riesgo_id" class="form-select" required>
                            <option value="">Seleccione una opción</option>
                            @foreach($tiposRiesgos as $riesgo)
                                <option value="{{ $riesgo->id }}">{{ $riesgo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tipo_accidente_id" class="form-label">🚑 Tipo de Accidente</label>
                        <select name="tipo_accidente_id" class="form-select" required>
                            <option value="">Seleccione una opción</option>
                            @foreach($tiposAccidentes as $accidente)
                                <option value="{{ $accidente->id }}">{{ $accidente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">📝 Descripción</label>
                    <textarea name="descripcion" class="form-control" rows="3" placeholder="Describa el accidente...">{{ old('descripcion') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="evidencia" class="form-label">📎 Evidencia</label>
                    <textarea name="evidencia" class="form-control" rows="2" placeholder="Detalles de la evidencia...">{{ old('evidencia') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="gravedad" class="form-label">❗ Gravedad</label>
                        <select name="gravedad" class="form-select" required>
                            <option value="">Seleccione la gravedad</option>
                            <option value="leve">Leve</option>
                            <option value="moderada">Moderada</option>
                            <option value="grave">Grave</option>
                            <option value="fatal">Fatal</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="creado_por" class="form-label">👤 Creado por</label>
                        <input type="text" name="creado_por" class="form-control" value="{{ old('creado_por') }}" required>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-2"></i>Registrar Accidente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
