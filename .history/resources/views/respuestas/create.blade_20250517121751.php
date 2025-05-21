@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="card-header text-white" style="background: linear-gradient(135deg, #005995 0%, #00838f 100%);">
            <div class="d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-shield-check fs-2"></i>
                </div>
                <div>
                    <h2 class="mb-0 fw-bold">Registrar Respuesta a Evento</h2>
                    <p class="mb-0 opacity-75">Sistema de Gestión de Seguridad y Salud en el Trabajo</p>
                </div>
            </div>
        </div>

        <div class="card-body bg-light">
            <form action="{{ route('respuestas.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf

                <!-- Selección de evento -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header" style="background-color: #e3f2fd;">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-search me-2 text-primary"></i>
                            <h5 class="mb-0 fw-bold text-primary">Selección del Evento</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="tipo_evento" class="form-label fw-bold">Tipo de Evento</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white"><i class="bi bi-funnel"></i></span>
                                <select name="tipo_evento" id="tipo_evento" class="form-select" required onchange="mostrarEventos()">
                                    <option value="">Seleccione un tipo</option>
                                    <option value="accidente">Accidente</option>
                                    <option value="incidente">Incidente</option>
                                    <option value="emergencia">Emergencia</option>
                                    <option value="acto_inseguro">Acto Inseguro</option>
                                </select>
                            </div>
                            <div class="invalid-feedback">Por favor seleccione un tipo de evento</div>
                        </div>

                        <div class="mb-3" id="evento_id_container" style="display: none;">
                            <label for="evento_id" class="form-label fw-bold">Evento específico</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white"><i class="bi bi-list-ul"></i></span>
                                <select name="evento_id" id="evento_id" class="form-select" required onchange="mostrarDetalles()">
                                    <option value="">Seleccione un evento</option>
                                </select>
                            </div>
                            <div class="invalid-feedback">Por favor seleccione un evento</div>
                        </div>
                    </div>
                </div>

                <!-- Detalles del evento -->
                <div class="card mb-4 shadow-sm border-0" id="tabla_detalles" style="display: none;">
                    <div class="card-header" style="background-color: #FFF3CD;">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle me-2 text-warning"></i>
                            <h5 class="mb-0 fw-bold text-warning">Detalles del Evento</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <tbody id="detalle_evento_body"></tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6" id="personas_involucradas_container">
                                <h6 class="fw-bold mb-3">Personas Involucradas</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nombre Completo</th>
                                                <th>Cargo</th>
                                                <th>Tipo</th>
                                            </tr>
                                        </thead>
                                        <tbody id="personas_involucradas_body"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Respuesta -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header" style="background-color: #D4EDDA;">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-chat-square-text me-2 text-success"></i>
                            <h5 class="mb-0 fw-bold text-success">Respuesta al Evento</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label for="respuesta" class="form-label fw-bold">Descripción de la Respuesta</label>
                            <div class="input-group">
                                <span class="input-group-text bg-success text-white"><i class="bi bi-chat-dots"></i></span>
                                <textarea name="respuesta" class="form-control" rows="4" required>{{ old('respuesta') }}</textarea>
                            </div>
                            <div class="invalid-feedback">Por favor describa la respuesta</div>
                        </div>

                        <div class="mb-3">
                            <label for="acciones_tomadas" class="form-label fw-bold">Acciones Tomadas</label>
                            <div class="input-group">
                                <span class="input-group-text bg-success text-white"><i class="bi bi-check2-square"></i></span>
                                <textarea name="acciones_tomadas" class="form-control" rows="4" required>{{ old('acciones_tomadas') }}</textarea>
                            </div>
                            <div class="invalid-feedback">Por favor describa las acciones</div>
                        </div>
                    </div>
                </div>

                <!-- Información de registro -->
                <div class="card mb-4 shadow-sm border-0">
                    <div class="card-header" style="background-color: #F8F9FA;">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-person-badge me-2 text-secondary"></i>
                            <h5 class="mb-0 fw-bold text-secondary">Información de Registro</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fecha_respuesta" class="form-label fw-bold">Fecha de Respuesta</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary text-white"><i class="bi bi-calendar-date"></i></span>
                                    <input type="datetime-local" name="fecha_respuesta" class="form-control" required>
                                </div>
                                <div class="invalid-feedback">Ingrese la fecha</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="respondido_por" class="form-label fw-bold">Respondido por</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary text-white"><i class="bi bi-person"></i></span>
                                    <input type="text" name="respondido_por" class="form-control" value="{{ auth()->user()->name }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn text-white px-4 py-2" style="background: linear-gradient(135deg, #005995 0%, #00838f 100%);">
                        <i class="bi bi-save me-2"></i>Guardar Respuesta
                    </button>
                    <a href="{{ route('respuestas.index') }}" class="btn btn-outline-secondary px-4 py-2">
                        <i class="bi bi-x-circle me-2"></i>Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Script para mostrar eventos y detalles -->
<script>
    const eventos = {
        accidente: @json($accidentes->load('personasInvolucradas') ?? []),
        incidente: @json($incidentes ?? []),
        emergencia: @json($emergencias ?? []),
        acto_inseguro: @json($actos ?? [])
    };

    const coloresTipos = {
        accidente: "#dc3545",
        incidente: "#fd7e14",
        emergencia: "#ffc107",
        acto_inseguro: "#6c757d"
    };

    function mostrarEventos() {
        const tipo = document.getElementById('tipo_evento').value;
        const select = document.getElementById('evento_id');
        const container = document.getElementById('evento_id_container');
        const tabla = document.getElementById('tabla_detalles');
        select.innerHTML = '<option value="">Seleccione un evento</option>';

        if (tipo && eventos[tipo]) {
            eventos[tipo].forEach(evento => {
                select.innerHTML += `<option value="${evento.id}">${evento.descripcion ?? evento.titulo ?? 'Evento #' + evento.id}</option>`;
            });
            container.style.display = 'block';
        } else {
            container.style.display = 'none';
            tabla.style.display = 'none';
        }
    }

    function mostrarDetalles() {
        const tipo = document.getElementById('tipo_evento').value;
        const eventoId = document.getElementById('evento_id').value;
        const evento = eventos[tipo].find(e => e.id == eventoId);

        const cuerpoDetalles = document.getElementById('detalle_evento_body');
        const cuerpoPersonas = document.getElementById('personas_involucradas_body');

        cuerpoDetalles.innerHTML = '';
        cuerpoPersonas.innerHTML = '';

        if (!evento) return;

        for (let clave in evento) {
            if (['id', 'personas_involucradas', 'created_at', 'updated_at'].includes(clave)) continue;
            cuerpoDetalles.innerHTML += `
                <tr>
                    <th class="text-end text-muted">${clave.replace(/_/g, ' ').toUpperCase()}</th>
                    <td>${evento[clave]}</td>
                </tr>`;
        }

        if (evento.personas_involucradas) {
            evento.personas_involucradas.forEach(p => {
                cuerpoPersonas.innerHTML += `
                    <tr>
                        <td>${p.nombre}</td>
                        <td>${p.cargo}</td>
                        <td>${p.tipo}</td>
                    </tr>`;
            });
        }

        document.getElementById('tabla_detalles').style.display = 'block';
    }
</script>
@endsection
