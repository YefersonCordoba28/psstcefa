@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-center">Editar Accidente</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">Modificar Datos del Accidente</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('accidentes.update', $accidente->id) }}">
                            @csrf
                            @method('PUT')

                            {{-- Fecha y Hora --}}
                            <div class="mb-3">
                                <label for="fecha_hora" class="form-label">Fecha y Hora</label>
                                <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control" value="{{ old('fecha_hora', $accidente->fecha_hora) }}">
                            </div>

                            {{-- Área/Unidad --}}
                            <div class="mb-3">
                                <label for="area_unidad_productiva_id" class="form-label">Área/Unidad</label>
                                <select name="area_unidad_productiva_id" id="area_unidad_productiva_id" class="form-select">
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}" @if($area->id == $accidente->areaUnidadProductiva->id) selected @endif>{{ $area->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tipo de Lesión --}}
                            <div class="mb-3">
                                <label for="tipo_lesion_id" class="form-label">Tipo de Lesión</label>
                                <select name="tipo_lesion_id" id="tipo_lesion_id" class="form-select">
                                    @foreach ($lesiones as $lesion)
                                        <option value="{{ $lesion->id }}" @if($lesion->id == $accidente->tipoLesion->id) selected @endif>{{ $lesion->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tipo de Riesgo --}}
                            <div class="mb-3">
                                <label for="tipo_riesgo_id" class="form-label">Tipo de Riesgo</label>
                                <select name="tipo_riesgo_id" id="tipo_riesgo_id" class="form-select">
                                    @foreach ($riesgos as $riesgo)
                                        <option value="{{ $riesgo->id }}" @if($riesgo->id == $accidente->tipoRiesgo->id) selected @endif>{{ $riesgo->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tipo de Accidente --}}
                            <div class="mb-3">
                                <label for="tipo_accidente_id" class="form-label">Tipo de Accidente</label>
                                <select name="tipo_accidente_id" id="tipo_accidente_id" class="form-select">
                                    @foreach ($tiposAccidente as $tipo)
                                        <option value="{{ $tipo->id }}" @if($tipo->id == $accidente->tipoAccidente->id) selected @endif>{{ $tipo->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Gravedad --}}
                            <div class="mb-3">
                                <label for="gravedad" class="form-label">Gravedad</label>
                                <select name="gravedad" id="gravedad" class="form-select">
                                    <option value="leve" @if($accidente->gravedad == 'leve') selected @endif>Leve</option>
                                    <option value="moderada" @if($accidente->gravedad == 'moderada') selected @endif>Moderada</option>
                                    <option value="grave" @if($accidente->gravedad == 'grave') selected @endif>Grave</option>
                                    <option value="fatal" @if($accidente->gravedad == 'fatal') selected @endif>Fatal</option>
                                </select>
                            </div>

                            {{-- Descripción --}}
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion', $accidente->descripcion) }}</textarea>
                            </div>

                            {{-- Evidencia --}}
                            <div class="mb-3">
                                <label for="evidencia" class="form-label">Evidencia</label>
                                <input type="text" name="evidencia" id="evidencia" class="form-control" value="{{ old('evidencia', $accidente->evidencia) }}">
                            </div>

                            {{-- Creado Por --}}
                            <div class="mb-3">
                                <label for="creado_por" class="form-label">Creado Por</label>
                                <input type="text" name="creado_por" id="creado_por" class="form-control" value="{{ old('creado_por', $accidente->creado_por) }}">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Actualizar Accidente</button>
                                <a href="{{ route('accidentes.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
