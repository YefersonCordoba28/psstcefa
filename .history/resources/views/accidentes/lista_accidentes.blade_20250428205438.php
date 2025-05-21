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
                <div class="col-12 col-md-8 col-lg-6">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Formulario de Edición</h5>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('accidentes.update', $accidente->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="fecha_hora">Fecha y Hora</label>
                                        <input type="datetime-local" name="fecha_hora" id="fecha_hora" class="form-control" 
                                               value="{{ \Carbon\Carbon::parse($accidente->fecha_hora)->format('Y-m-d\TH:i') }}" required>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="area_unidad_productiva_id">Área/Unidad Productiva</label>
                                        <select name="area_unidad_productiva_id" id="area_unidad_productiva_id" class="form-control" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}" {{ $datos->area_unidad_productiva_id == $area->id ? 'selected' : '' }}>
                                                    {{ $area->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="tipo_lesion_id">Tipo de Lesión</label>
                                        <select name="tipo_lesion_id" id="tipo_lesion_id" class="form-control" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($tiposLesion as $tipoLesion)
                                                <option value="{{ $tipoLesion->id }}" {{ $accidente->tipo_lesion_id == $tipoLesion->id ? 'selected' : '' }}>
                                                    {{ $tipoLesion->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="tipo_riesgo_id">Tipo de Riesgo</label>
                                        <select name="tipo_riesgo_id" id="tipo_riesgo_id" class="form-control" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($tiposRiesgo as $tipoRiesgo)
                                                <option value="{{ $tipoRiesgo->id }}" {{ $accidente->tipo_riesgo_id == $tipoRiesgo->id ? 'selected' : '' }}>
                                                    {{ $tipoRiesgo->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="tipo_accidente_id">Tipo de Accidente</label>
                                        <select name="tipo_accidente_id" id="tipo_accidente_id" class="form-control" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($tiposAccidente as $tipoAccidente)
                                                <option value="{{ $tipoAccidente->id }}" {{ $accidente->tipo_accidente_id == $tipoAccidente->id ? 'selected' : '' }}>
                                                    {{ $tipoAccidente->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="gravedad">Gravedad</label>
                                        <select name="gravedad" id="gravedad" class="form-control" required>
                                            <option value="leve" {{ $accidente->gravedad == 'leve' ? 'selected' : '' }}>Leve</option>
                                            <option value="moderada" {{ $accidente->gravedad == 'moderada' ? 'selected' : '' }}>Moderada</option>
                                            <option value="grave" {{ $accidente->gravedad == 'grave' ? 'selected' : '' }}>Grave</option>
                                            <option value="fatal" {{ $accidente->gravedad == 'fatal' ? 'selected' : '' }}>Fatal</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="descripcion">Descripción</label>
                                        <textarea name="descripcion" id="descripcion" class="form-control" rows="3">{{ $accidente->descripcion }}</textarea>
                                    </div>
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="evidencia">Evidencia</label>
                                        <textarea name="evidencia" id="evidencia" class="form-control" rows="3">{{ $accidente->evidencia }}</textarea>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="creado_por">Creado Por</label>
                                        <input type="text" name="creado_por" id="creado_por" class="form-control" 
                                               value="{{ $accidente->creado_por }}" required>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-success btn-sm">Actualizar</button>
                                    <a href="{{ route('accidentes.index') }}" class="btn btn-secondary btn-sm">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        @media (max-width: 768px) {
            .card {
                margin: 0 0.5rem;
            }
            .form-group label {
                font-size: 0.9rem;
            }
            .form-control {
                font-size: 0.9rem;
            }
            .btn-sm {
                font-size: 0.85rem;
                padding: 0.25rem 0.5rem;
            }
        }

        @media (max-width: 576px) {
            .card-header h5 {
                font-size: 1.1rem;
            }
            .form-group label {
                font-size: 0.85rem;
            }
            .form-control {
                font-size: 0.85rem;
            }
            .btn-sm {
                font-size: 0.75rem;
                padding: 0.2rem 0.4rem;
            }
            .d-flex {
                flex-direction: column;
                gap: 0.5rem;
            }
        }
    </style>
@endsection