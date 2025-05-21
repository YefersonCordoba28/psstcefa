@extends('layouts.master')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg border-0">
        <!-- Encabezado con degradado de colores SST -->
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
                
                <!-- Sección de selección de evento -->
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
                                <span class="input-group-text bg-primary text-white">
                                    <i class="bi bi-funnel"></i>
                                </span>
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
                                <span class="input-group-text bg-primary text-white">
                                    <i class="bi bi-list-ul"></i>
                                </span>
                                <select name="evento_id" id="evento_id" class="form-select" required onchange="mostrarDetalles()">
                                    <option value="">Seleccione un evento</option>
                                </select>
                            </div>
                            <div class="invalid-feedback">Por favor seleccione un evento</div>
                        </div>
                    </div>
                </div>
                
                <!-- Detalles del evento (dinámico) -->
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
                                        <tbody id="detalle_evento_body">
                                            <!-- Detalles cargados dinámicamente -->
                                        </tbody>
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
                                                <th>Tipo de Involucramiento</th>
                                                <th>Tipo de Lesión</th>
                                            </tr>
                                        </thead>
                                        <tbody id="personas_involucradas_body">
                                            <!-- Personas cargadas dinámicamente -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Sección de respuesta y acciones -->
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
                                <span class="input-group-text bg-success text-white">
                                    <i class="bi bi-chat-dots"></i>
                                </span>
                                <textarea name="respuesta" class="form-control" rows="4" required>{{ old('respuesta') }}</textarea>
                            </div>
                            <div class="invalid-feedback">Por favor describa la respuesta al evento</div>
                        </div>

                        <div class="mb-3">
                            <label for="acciones_tomadas" class="form-label fw-bold">Acciones Tomadas</label>
                            <div class="input-group">
                                <span class="input-group-text bg-success text-white">
                                    <i class="bi bi-check2-square"></i>
                                </span>
                                <textarea name="acciones_tomadas" class="form-control" rows="4" required>{{ old('acciones_tomadas') }}</textarea>
                            </div>
                            <div class="invalid-feedback">Por favor describa las acciones tomadas</div>
                        </div>
                    </div>
                </div>
                
                <!-- Sección de fecha y responsable -->
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
                                    <span class="input-group-text bg-secondary text-white">
                                        <i class="bi bi-calendar-date"></i>
                                    </span>
                                    <input type="datetime-local" name="fecha_respuesta" class="form-control" required>
                                </div>
                                <div class="invalid-feedback">Por favor ingrese la fecha de respuesta</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="respondido_por" class="form-label fw-bold">Respondido por</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-secondary text-white">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input type="text" name="respondido_por" class="form-control" value="{{ auth()->user()->name }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Botones de acción -->
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

<!-- CSS Personalizado -->
<style>
    /* Estilos generales */
    body {
        background-color: #f5f7fa;
    }
    
    /* Estilos para los campos del formulario con foco */
    .form-control:focus, .form-select:focus {
        border-color: #005995;
        box-shadow: 0 0 0 0.25rem rgba(0, 89, 149, 0.25);
    }
    
    /* Animación sutil para los cards */
    .card {
        transition: all 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-2px);
    }
    
    /* Estilo para resaltar cada fila de la tabla al pasar el cursor */
    .table-hover tbody tr:hover {
        background-color: rgba(0, 89, 149, 0.05);
    }
    
    /* Mejoras visuales para los campos de entrada */
    .form-control, .form-select {
        border-radius: 0.375rem;
    }
    
    /* Estilos especiales para cada tipo de evento */
    .tipo-accidente { color: #dc3545; }
    .tipo-incidente { color: #fd7e14; }
    .tipo-emergencia { color: #ffc107; }
    .tipo-acto-inseguro { color: #6c757d; }
    
    /* Efecto de transición para los elementos que aparecen/desaparecen */
    #evento_id_container, #tabla_detalles {
        transition: opacity 0.3s ease;
    }
    
    /* Estilo para la tabla de personas involucradas */
    #personas_involucradas_container {
        border-left: 1px solid #dee2e6;
        padding-left: 20px;
    }
    
    #personas_involucradas_body tr td {
        padding: 0.5rem;
        vertical-align: middle;
    }
    
    /* Estilo para la tabla de personas */
    .table-personas {
        font-size: 0.875rem;
    }
    
    .table-personas th {
        background-color: #f8f9fa;
    }
</style>

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

    // Eventos con personas involucradas y sus detalles
    const eventos = {
        accidente: @json($accidentes->load(['personasInvolucradas', 'tipoAccidente']) ?? []),
        incidente: @json($incidentes ?? []),
        emergencia: @json($emergencias ?? []),
        acto_inseguro: @json($actos ?? [])
    };

    // Colores para cada tipo de evento
    const coloresTipos = {
        accidente: "#dc3545",      // Rojo
        incidente: "#fd7e14",      // Naranja
        emergencia: "#ffc107",     // Amarillo
        acto_inseguro: "#6c757d"   // Gris
    };

    // Funciones de JS con mejoras visuales
    function mostrarEventos() {
        const tipo = document.getElementById('tipo_evento').value;
        const select = document.getElementById('evento_id');
        const container = document.getElementById('evento_id_container');
        const tabla = document.getElementById('tabla_detalles');
        const tbody = document.getElementById('detalle_evento_body');
        const personasBody = document.getElementById('personas_involucradas_body');

        select.innerHTML = '<option value="">Seleccione un evento</option>';
        tbody.innerHTML = '';
        personasBody.innerHTML = '';
        
        // Ocultar con transición
        if (tabla.style.display !== 'none') {
            tabla.style.opacity = '0';
            setTimeout(() => { tabla.style.display = 'none'; }, 300);
        }

        if (tipo && eventos[tipo]) {
            // Cambiar el color del borde del select según el tipo de evento
            select.style.borderColor = coloresTipos[tipo];
            
            // Mostrar con transición
            container.style.opacity = '0';
            container.style.display = 'block';
            setTimeout(() => { container.style.opacity = '1'; }, 10);
            
            eventos[tipo].forEach(evento => {
                const option = document.createElement('option');
                option.value = evento.id;
                
                // Texto del option: ID + descripción corta + personas involucradas (solo para accidentes)
                let optionText = `ID ${evento.id} - ${evento.descripcion?.slice(0, 30) ?? 'sin descripción'}`;
                
                if (tipo === 'accidente') {
                    // Mostrar tipo de accidente si está disponible
                    if (evento.tipo_accidente) {
                        optionText += ` - ${evento.tipo_accidente.nombre}`;
                    }
                    // Mostrar número de personas involucradas
                    if (evento.personas_involucradas) {
                        optionText += ` (${evento.personas_involucradas.length} personas)`;
                    }
                }
                
                option.text = optionText;
                select.appendChild(option);
            });
        } else {
            container.style.opacity = '0';
            setTimeout(() => { container.style.display = 'none'; }, 300);
        }
    }

    function mostrarDetalles() {
        const tipo = document.getElementById('tipo_evento').value;
        const id = parseInt(document.getElementById('evento_id').value);
        const evento = eventos[tipo]?.find(e => e.id === id);

        const tbody = document.getElementById('detalle_evento_body');
        const tabla = document.getElementById('tabla_detalles');
        const personasBody = document.getElementById('personas_involucradas_body');
        
        tbody.innerHTML = '';
        personasBody.innerHTML = '';

        if (evento) {
            // Actualizar el encabezado de la tabla según el tipo
            const headerColor = coloresTipos[tipo];
            const headerText = document.querySelector('#tabla_detalles .card-header h5');
            const headerIcon = document.querySelector('#tabla_detalles .card-header i');
            
            headerText.textContent = `Detalles del ${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`;
            headerText.style.color = headerColor;
            headerIcon.style.color = headerColor;
            
            // Mostrar con transición
            tabla.style.opacity = '0';
            tabla.style.display = 'block';
            setTimeout(() => { tabla.style.opacity = '1'; }, 10);

            // Mostrar detalles del evento
            for (let key in evento) {
                if (evento.hasOwnProperty(key) && 
                    key !== 'id' && 
                    key !== 'personas_involucradas' && 
                    key !== 'tipo_accidente' &&
                    key !== 'created_at' &&
                    key !== 'updated_at') {
                    
                    const row = document.createElement('tr');
                    const campo = document.createElement('th');
                    campo.textContent = key.replace(/_/g, ' ')
                                          .split(' ')
                                          .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                                          .join(' ');
                    campo.style.width = '30%';
                    const valor = document.createElement('td');
                    valor.className = 'fw-bold';

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
                            // Formatear fechas
                            if (key.includes('fecha')) {
                                valor.textContent = new Date(evento[key]).toLocaleDateString();
                            } else {
                                valor.textContent = evento[key] !== null ? evento[key] : 'No especificado';
                            }
                    }

                    row.appendChild(campo);
                    row.appendChild(valor);
                    tbody.appendChild(row);
                }
            }

            // Mostrar tipo de accidente si está disponible
            if (tipo === 'accidente' && evento.tipo_accidente) {
                const row = document.createElement('tr');
                const campo = document.createElement('th');
                campo.textContent = 'Tipo de Accidente';
                campo.style.width = '30%';
                const valor = document.createElement('td');
                valor.className = 'fw-bold';
                valor.textContent = evento.tipo_accidente.nombre;
                
                row.appendChild(campo);
                row.appendChild(valor);
                tbody.appendChild(row);
            }

            // Mostrar personas involucradas (solo para accidentes)
            if (tipo === 'accidente' && evento.personas_involucradas) {
                evento.personas_involucradas.forEach(persona => {
                    const row = document.createElement('tr');
                    
                    // Nombre completo (nombre + apellido)
                    const tdNombre = document.createElement('td');
                    tdNombre.textContent = `${persona.nombre || 'Sin nombre'} ${persona.apellido || ''}`.trim();
                    
                    // Cargo
                    const tdCargo = document.createElement('td');
                    tdCargo.textContent = persona.cargo || 'No especificado';
                    
                    // Tipo de involucramiento (afectado, testigo, etc.)
                    const tdTipo = document.createElement('td');
                    tdTipo.textContent = persona.tipo_involucramiento || 'No especificado';
                    
                    // Tipo de lesión (si aplica)
                    const tdLesion = document.createElement('td');
                    if (persona.tipo_lesion_id) {
                        const tipoLesion = mapeoDatos.tipos_lesiones.find(t => t.id === persona.tipo_lesion_id);
                        tdLesion.textContent = tipoLesion ? tipoLesion.nombre : 'No especificado';
                    } else {
                        tdLesion.textContent = 'No aplica';
                    }
                    
                    row.appendChild(tdNombre);
                    row.appendChild(tdCargo);
                    row.appendChild(tdTipo);
                    row.appendChild(tdLesion);
                    personasBody.appendChild(row);
                });
                
                // Si no hay personas involucradas
                if (evento.personas_involucradas.length === 0) {
                    const row = document.createElement('tr');
                    const td = document.createElement('td');
                    td.colSpan = 4;
                    td.className = 'text-center text-muted';
                    td.textContent = 'No hay personas involucradas registradas';
                    row.appendChild(td);
                    personasBody.appendChild(row);
                }
            }
        } else {
            tabla.style.opacity = '0';
            setTimeout(() => { tabla.style.display = 'none'; }, 300);
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
    
    // Código para presetear la fecha actual al cargar el formulario
    document.addEventListener('DOMContentLoaded', function() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        
        const fechaActual = `${year}-${month}-${day}T${hours}:${minutes}`;
        document.querySelector('input[name="fecha_respuesta"]').value = fechaActual;
    });
</script>
@endsection