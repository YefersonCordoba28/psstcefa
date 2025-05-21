@extends('instructor.dashboard')

@section('content')
<div class="container py-4">
    <div class="card shadow border-0">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-exclamation-circle me-2"></i>Registrar Incidente</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <form action="{{ route('incidentes.store') }}" method="POST">
                @csrf

                {{-- Fecha y hora --}}
                <div class="mb-4">
                    <label for="fecha_hora" class="form-label fw-semibold">
                        <i class="fas fa-calendar-alt me-1"></i>Fecha y Hora del Incidente
                    </label>
                    <input type="datetime-local" name="fecha_hora" class="form-control" value="{{ old('fecha_hora') }}" required>
                </div>

                {{-- Área --}}
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

                {{-- Tipo de riesgo y tipo de incidente --}}
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
                        <label for="tipo_incidente_id" class="form-label fw-semibold">
                            <i class="fas fa-bolt me-1"></i>Tipo de Incidente
                        </label>
                        <select name="tipo_incidente_id" class="form-select" required>
                            <option value="">Seleccione una opción</option>
                            @foreach($tiposIncidentes as $incidente)
                                <option value="{{ $incidente->id }}">{{ $incidente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Descripción --}}
