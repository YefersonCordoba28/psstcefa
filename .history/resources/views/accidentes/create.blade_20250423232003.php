@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Registrar Accidente</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('accidentes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="fecha_hora" class="form-label">Fecha y Hora del Accidente</label>
            <input type="datetime-local" name="fecha_hora" class="form-control" value="{{ old('fecha_hora') }}" required>
        </div>

        <div class="mb-3">
            <label for="area_unidad_productiva_id" class="form-label">Área o Unidad Productiva</label>
            <select name="area_unidad_productiva_id" class="form-control" required>
                <option value="">Seleccione una opción</option>
                @foreach($areas as $area)
                    <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo_lesion_id" class="form-label">Tipo de Lesión</label>
            <select name="tipo_lesion_id" class="form-control" required>
                <option value="">Seleccione una opción</option>
                @foreach($tipo as $lesion)
                    <option value="{{ $lesion->id }}">{{ $lesion->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo_riesgo_id" class="form-label">Tipo de Riesgo</label>
            <select name="tipo_riesgo_id" class="form-control" required>
                <option value="">Seleccione una opción</option>
                @foreach($riesgos as $riesgo)
                    <option value="{{ $riesgo->id }}">{{ $riesgo->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo_accidente_id" class="form-label">Tipo de Accidente</label>
            <select name="tipo_accidente_id" class="form-control" required>
                <option value="">Seleccione una opción</option>
                @foreach($tiposAccidentes as $tipo)
                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="evidencia" class="form-label">Evidencia</label>
            <textarea name="evidencia" class="form-control" rows="2">{{ old('evidencia') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="gravedad" class="form-label">Gravedad</label>
            <select name="gravedad" class="form-control" required>
                <option value="">Seleccione la gravedad</option>
                <option value="leve">Leve</option>
                <option value="moderada">Moderada</option>
                <option value="grave">Grave</option>
                <option value="fatal">Fatal</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="creado_por" class="form-label">Creado por</label>
            <input type="text" name="creado_por" class="form-control" value="{{ old('creado_por') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Accidente</button>
    </form>
</div>
@endsection
