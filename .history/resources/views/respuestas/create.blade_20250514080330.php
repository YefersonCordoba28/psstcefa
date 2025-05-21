@extends('layouts.master')

@section('content')
<div class="container mt-4 text-white">
    <div class="bg-dark p-4 rounded shadow-lg border border-info">
        <h2 class="text-info mb-4"><i class="bi bi-pencil-square"></i> Registrar Respuesta a Evento</h2>

        <form action="{{ route('respuestas.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="tipo_evento" class="form-label text-info"><i class="bi bi-exclamation-triangle"></i> Tipo de Evento</label>
                <select name="tipo_evento" id="tipo_evento" class="form-select bg-secondary text-white border-info" required onchange="mostrarEventos()">
                    <option value="">Seleccione un tipo</option>
                    <option value="accidente">Accidente</option>
                    <option value="incidente">Incidente</option>
                    <option value="emergencia">Emergencia</option>
                    <option value="acto_inseguro">Acto Inseguro</option>
                </select>
            </div>

            <div class="mb-3" id="evento_id_container" style="display: none;">
                <label for="evento_id" class="form-label text-info"><i class="bi bi-list-check"></i> Seleccione el Evento</label>
                <select name="evento_id" id="evento_id" class="form-select bg-secondary text-white border-info" required onchange="mostrarDetalles()">
                    <option value="">Seleccione un evento</option>
                </select>
            </div>

            <div class="mb-4" id="tabla_detalles" style="display: none;">
                <h5 class="text-info"><i class="bi bi-info-circle-fill"></i> Detalles del Evento</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-dark table-striped table-hover border border-info">
                        <tbody id="detalle_evento_body">
                            <!-- Detalles cargados dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mb-3">
                <label for="respuesta" class="form-label text-info"><i class="bi bi-chat-left-text"></i> Respuesta</label>
                <textarea name="respuesta" class="form-control bg-secondary text-white border-info" rows="3">{{ old('respuesta') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="acciones_tomadas" class="form-label text-info"><i class="bi bi-tools"></i> Acciones Tomadas</label>
                <textarea name="acciones_tomadas" class="form-control bg-secondary text-white border-info" rows="3">{{ old('acciones_tomadas') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="fecha_respuesta" class="form-label text-info"><i class="bi bi-calendar-check"></i> Fecha de Respuesta</label>
                <input type="datetime-local" name="fecha_respuesta" class="form-control bg-secondary text-white border-info" required>
            </div>

            <div class="mb-4">
                <label for="respondido_por" class="form-label text-info"><i class="bi bi-person-check"></i> Respondido por</label>
                <input type="text" name="respondido_por" class="form-control bg-secondary text-white border-info" value="{{ old('respondido_por') }}">
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success px-4 shadow-sm"><i class="bi bi-save2"></i> Guardar</button>
                <a href="{{ route('respuestas.index') }}" class="btn btn-outline-info px-4 shadow-sm"><i class="bi bi-x-circle"></i> Cancelar</a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

@include('respuestas.script') {{-- Mueve el script JS a un archivo separado si lo deseas --}}
@endsection
