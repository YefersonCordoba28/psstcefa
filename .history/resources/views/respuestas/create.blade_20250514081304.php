@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="card border-primary shadow-lg">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0"><i class="bi bi-clipboard2-pulse me-2"></i>Registrar Respuesta a Evento</h2>
        </div>
        
        <div class="card-body">
            <form action="{{ route('respuestas.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <!-- Sección de selección de evento -->
                <div class="card mb-4 border-secondary">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Información del Evento</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="tipo_evento" class="form-label">Tipo de Evento</label>
                            <select name="tipo_evento" id="tipo_evento" class="form-select" required onchange="mostrarEventos()">
                                <option value="">Seleccione un tipo</option>
                                <option value="accidente">Accidente</option>
                                <option value="incidente">Incidente</option>
                                <option value="emergencia">Emergencia</option>
                                <option value="acto_inseguro">Acto Inseguro</option>
                            </select>
                            <div class="invalid-feedback">Por favor seleccione un tipo de evento</div>
                        </div>

                        <div class="mb-3" id="evento_id_container" style="display: none;">
                            <label for="evento_id" class="form-label">Evento específico</label>
                            <select name="evento_id" id="evento_id" class="form-select" required onchange="mostrarDetalles()">
                                <option value="">Seleccione un evento</option>
                            </select>
                            <div class="invalid-feedback">Por favor seleccione un evento</div>
                        </div>
                    </div>
                </div>
                
                <!-- Detalles del evento (dinámico) -->
                <div class="card mb-4 border-info" id="tabla_detalles" style="display: none;">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Detalles del Evento Seleccionado</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <tbody id="detalle_evento_body">
                                    <!-- Detalles cargados dinámicamente -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Sección de respuesta y acciones -->
                <div class="card mb-4 border-success">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-chat-square-text me-2"></i>Respuesta</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="respuesta" class="form-label">Descripción de la Respuesta</label>
                            <textarea name="respuesta" class="form-control" rows="4" required>{{ old('respuesta') }}</textarea>
                            <div class="invalid-feedback">Por favor describa la respuesta al evento</div>
                        </div>

                        <div class="mb-3">
                            <label for="acciones_tomadas" class="form-label">Acciones Tomadas</label>
                            <textarea name="acciones_tomadas" class="form-control" rows="4" required>{{ old('acciones_tomadas') }}</textarea>
                            <div class="invalid-feedback">Por favor describa las acciones tomadas</div>
                        </div>
                    </div>
                </div>
                
                <!-- Sección de fecha y responsable (movida a la parte inferior) -->
                <div class="card mb-4 border-secondary">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Información de Registro</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="fecha_respuesta" class="form-label">Fecha de Respuesta</label>
                                <input type="datetime-local" name="fecha_respuesta" class="form-control" required>
                                <div class="invalid-feedback">Por favor ingrese la fecha de respuesta</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="respondido_por" class="form-label">Respondido por</label>
                                <input type="text" name="respondido_por" class="form-control" value="{{ old('respondido_por') }}" required>
                                <div class="invalid-feedback">Por favor ingrese el nombre del responsable</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Botones de acción -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-save me-2"></i>Guardar Respuesta
                    </button>
                    <a href="{{ route('respuestas.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-x-circle me-2"></i>Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<script>
    // Mapeo de datos (sin cambios)
    const mapeoDatos = {
        areas_unidades: @json($areasUnidades ?? []),
        tipos_lesiones: @json($tiposLesiones ?? []),
        tipos_riesgos: @json($tiposRiesgos ?? []),
        tipos_accidentes: @json($tiposAccidentes ?? []),
        tipos_incidentes: @json($tipoIncidentes ?? []),
        tipos_emergencias: @json($tipoEmergencias ?? []),
        tipos_acto_inseguro: @json($tiposActoInseguro ?? [])
    };

    const eventos = {
        accidente: @json($accidentes ?? []),
        incidente: @json($incidentes ?? []),
        emergencia: @json($emergencias ?? []),
        acto_inseguro: @json($actos ?? [])
    };

    // Funciones (sin cambios)
    function mostrarEventos() {
        const tipo = document.getElementById('tipo_evento').value;
        const select = document.getElementById('evento_id');
        const container = document.getElementById('evento_id_container');
        const tabla = document.getElementById('tabla_detalles');
        const tbody = document.getElementById('detalle_evento_body');

        select.innerHTML = '<option value="">Seleccione un evento</option>';
        tbody.innerHTML = '';
        tabla.style.display = 'none';

        if (tipo && eventos[tipo]) {
            container.style.display = 'block';
            eventos[tipo].forEach(evento => {
                const option = document.createElement('option');
                option.value = evento.id;
                option.text = `ID ${evento.id} - ${evento.descripcion?.slice(0, 30) ?? 'sin descripción'}`;
                select.appendChild(option);
            });
        } else {
            container.style.display = 'none';
        }
    }

    function mostrarDetalles() {
        const tipo = document.getElementById('tipo_evento').value;
        const id = parseInt(document.getElementById('evento_id').value);
        const evento = eventos[tipo]?.find(e => e.id === id);

        const tbody = document.getElementById('detalle_evento_body');
        const tabla = document.getElementById('tabla_detalles');
        tbody.innerHTML = '';

        if (evento) {
            tabla.style.display = 'block';

            for (let key in evento) {
                if (evento.hasOwnProperty(key) && key !== 'id') {
                    const row = document.createElement('tr');
                    const campo = document.createElement('th');
                    campo.textContent = key.replaceAll('_', ' ');
                    const valor = document.createElement('td');

                    switch (key) {
                        case 'area_unidad_productiva_id':
                            const area = mapeoDatos.areas_unidades.find(a => a.id === evento[key]);
                            valor.textContent = area ? area.nombre : `ID ${evento[key]}`;
                            break;
                        case 'tipo_lesion_id':
                            const tipoLesion = mapeoDatos.tipos_lesiones.find(t => t.id === evento[key]);
                            valor.textContent = tipoLesion ? tipoLesion.nombre : `ID ${evento[key]}`;
                            break;
                        case 'tipo_riesgo_id':
                            const tipoRiesgo = mapeoDatos.tipos_riesgos.find(r => r.id === evento[key]);
                            valor.textContent = tipoRiesgo ? tipoRiesgo.nombre : `ID ${evento[key]}`;
                            break;
                        case 'tipo_accidente_id':
                            const tipoAccidente = mapeoDatos.tipos_accidentes.find(a => a.id === evento[key]);
                            valor.textContent = tipoAccidente ? tipoAccidente.nombre : `ID ${evento[key]}`;
                            break;
                        case 'tipo_incidente_id':
                            const tipoIncidente = mapeoDatos.tipos_incidentes.find(i => i.id === evento[key]);
                            valor.textContent = tipoIncidente ? tipoIncidente.nombre : `ID ${evento[key]}`;
                            break;
                        case 'tipo_emergencia_id':
                            const tipoEmergencia = mapeoDatos.tipos_emergencias.find(e => e.id === evento[key]);
                            valor.textContent = tipoEmergencia ? tipoEmergencia.nombre : `ID ${evento[key]}`;
                            break;
                        case 'tipo_acto_inseguro_id':
                            const tipoActoInseguro = mapeoDatos.tipos_acto_inseguro.find(a => a.id === evento[key]);
                            valor.textContent = tipoActoInseguro ? tipoActoInseguro.nombre : `ID ${evento[key]}`;
                            break;
                        default:
                            valor.textContent = evento[key];
                    }

                    row.appendChild(campo);
                    row.appendChild(valor);
                    tbody.appendChild(row);
                }
            }
        } else {
            tabla.style.display = 'none';
        }
    }

    // Validación de Bootstrap
    (function () {
        'use strict'
        
        var forms = document.querySelectorAll('.needs-validation')
        
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endsection