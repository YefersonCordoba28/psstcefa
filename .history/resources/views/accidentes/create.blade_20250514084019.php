@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-lg rounded-lg overflow-hidden">
        <div class="card-header bg-gradient-primary text-white p-4">
            <div class="d-flex align-items-center">
                <div class="display-icon rounded-circle bg-white bg-opacity-25 p-3 me-3">
                    <i class="bi bi-clipboard2-pulse fs-2"></i>
                </div>
                <div>
                    <h1 class="fw-bold mb-0">Registrar Respuesta a Evento</h1>
                    <p class="mb-0 opacity-75">Sistema Avanzado de Gestión de Incidentes</p>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <form action="{{ route('respuestas.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <!-- Indicador de progreso -->
                <div class="progress" style="height: 4px;">
                    <div class="progress-bar bg-primary" id="form-progress" role="progressbar" style="width: 0%"></div>
                </div>
                
                <div class="p-4">
                    <!-- Sección de selección de evento -->
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-light d-flex align-items-center p-3">
                            <span class="rounded-circle bg-primary text-white px-3 py-2 me-3">1</span>
                            <h5 class="fw-bold mb-0">Información del Evento</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <label for="tipo_evento" class="form-label fw-semibold">Tipo de Evento</label>
                                <select name="tipo_evento" id="tipo_evento" class="form-select form-select-lg shadow-sm" required onchange="mostrarEventos(); updateProgress()">
                                    <option value="">Seleccione un tipo</option>
                                    <option value="accidente">Accidente</option>
                                    <option value="incidente">Incidente</option>
                                    <option value="emergencia">Emergencia</option>
                                    <option value="acto_inseguro">Acto Inseguro</option>
                                </select>
                                <div class="invalid-feedback">Por favor seleccione un tipo de evento</div>
                            </div>

                            <div class="mb-3" id="evento_id_container" style="display: none;">
                                <label for="evento_id" class="form-label fw-semibold">Evento específico</label>
                                <select name="evento_id" id="evento_id" class="form-select shadow-sm" required onchange="mostrarDetalles(); updateProgress()">
                                    <option value="">Seleccione un evento</option>
                                </select>
                                <div class="invalid-feedback">Por favor seleccione un evento</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Detalles del evento (dinámico) -->
                    <div class="card mb-4 border-0 shadow-sm" id="tabla_detalles" style="display: none;">
                        <div class="card-header bg-info bg-opacity-10 d-flex align-items-center p-3">
                            <span class="rounded-circle bg-info text-white px-3 py-2 me-3">
                                <i class="bi bi-info"></i>
                            </span>
                            <h5 class="fw-bold mb-0 text-info">Detalles del Evento Seleccionado</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <tbody id="detalle_evento_body">
                                        <!-- Detalles cargados dinámicamente -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sección de respuesta y acciones -->
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-light d-flex align-items-center p-3">
                            <span class="rounded-circle bg-success text-white px-3 py-2 me-3">2</span>
                            <h5 class="fw-bold mb-0">Respuesta</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <label for="respuesta" class="form-label fw-semibold">Descripción de la Respuesta</label>
                                <textarea name="respuesta" id="respuesta" class="form-control shadow-sm" rows="4" required onkeyup="updateProgress()">{{ old('respuesta') }}</textarea>
                                <div class="invalid-feedback">Por favor describa la respuesta al evento</div>
                            </div>

                            <div class="mb-4">
                                <label for="acciones_tomadas" class="form-label fw-semibold">Acciones Tomadas</label>
                                <textarea name="acciones_tomadas" id="acciones_tomadas" class="form-control shadow-sm" rows="4" required onkeyup="updateProgress()">{{ old('acciones_tomadas') }}</textarea>
                                <div class="invalid-feedback">Por favor describa las acciones tomadas</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sección de fecha y responsable -->
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="card-header bg-light d-flex align-items-center p-3">
                            <span class="rounded-circle bg-primary text-white px-3 py-2 me-3">3</span>
                            <h5 class="fw-bold mb-0">Información de Registro</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_respuesta" class="form-label fw-semibold">Fecha de Respuesta</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-calendar-event"></i></span>
                                        <input type="datetime-local" name="fecha_respuesta" id="fecha_respuesta" class="form-control shadow-sm" required onchange="updateProgress()">
                                    </div>
                                    <div class="invalid-feedback">Por favor ingrese la fecha de respuesta</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="respondido_por" class="form-label fw-semibold">Respondido por</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                                        <input type="text" name="respondido_por" id="respondido_por" class="form-control shadow-sm" value="{{ old('respondido_por') }}" required onkeyup="updateProgress()">
                                    </div>
                                    <div class="invalid-feedback">Por favor ingrese el nombre del responsable</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Botones de acción -->
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-lg px-5 shadow">
                            <i class="bi bi-save me-2"></i>Guardar Respuesta
                        </button>
                        <a href="{{ route('respuestas.index') }}" class="btn btn-outline-secondary btn-lg px-5">
                            <i class="bi bi-x-circle me-2"></i>Cancelar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CSS -->
<style>
:root {
    --primary-color: #3a86ff;
    --secondary-color: #8338ec;
    --success-color: #06d6a0;
    --info-color: #118ab2;
    --warning-color: #ffd166;
    --danger-color: #ef476f;
    --light-color: #f8f9fa;
    --dark-color: #212529;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
}

.display-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.form-control:focus, .form-select:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(58, 134, 255, 0.25);
}

.btn-primary {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: var(--secondary-color);
    border-color: var(--secondary-color);
    transform: translateY(-2px);
}

/* Animación suave para mostrar elementos */
.card {
    transition: all 0.3s ease;
}

#tabla_detalles {
    animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Estilo para la tabla de detalles */
#detalle_evento_body th {
    text-transform: capitalize;
    width: 30%;
    color: var(--dark-color);
}

/* Estilo para resaltar filas */
#detalle_evento_body tr:hover {
    background-color: rgba(58, 134, 255, 0.05);
}
</style>

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

    // Funciones (sin cambios en la lógica)
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

    // Nueva función para la barra de progreso
    function updateProgress() {
        const tipo = document.getElementById('tipo_evento').value;
        const evento = document.getElementById('evento_id').value;
        const respuesta = document.getElementById('respuesta').value;
        const acciones = document.getElementById('acciones_tomadas').value;
        const fecha = document.getElementById('fecha_respuesta').value;
        const responsable = document.getElementById('respondido_por').value;
        
        let progress = 0;
        
        if (tipo) progress += 16.6;
        if (evento) progress += 16.6;
        if (respuesta) progress += 16.6;
        if (acciones) progress += 16.6;
        if (fecha) progress += 16.6;
        if (responsable) progress += 16.6;
        
        document.getElementById('form-progress').style.width = `${progress}%`;
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

    // Inicializar el progreso cuando la página carga
    document.addEventListener('DOMContentLoaded', function() {
        updateProgress();
    });
</script>
@endsection