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
                    <h2 class="mb-0 fw-bold">Registrar Respuesta a Persona Involucrada</h2>
                    <p class="mb-0 opacity-75">Sistema de Gestión de Seguridad y Salud en el Trabajo</p>
                </div>
            </div>
        </div>
        
        <div class="card-body bg-light">
            <form action="{{ route('respuestas.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                
                <!-- Sección de selección de persona involucrada -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header" style="background-color: #e3f2fd;">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-person-lines-fill me-2 text-primary"></i>
                            <h5 class="mb-0 fw-bold text-primary">Selección de Persona Involucrada</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="tipo_evento" class="form-label fw-bold">Tipo de Evento</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="bi bi-funnel"></i>
                                </span>
                                <select name="tipo_evento" id="tipo_evento" class="form-select" required onchange="mostrarPersonas()">
                                    <option value="">Seleccione un tipo</option>
                                    <option value="accidente">Accidente</option>
                                    <option value="incidente">Incidente</option>
                                    <option value="emergencia">Emergencia</option>
                                    <option value="acto_inseguro">Acto Inseguro</option>
                                </select>
                            </div>
                            <div class="invalid-feedback">Por favor seleccione un tipo de evento</div>
                        </div>

                        <div class="mb-3" id="persona_id_container" style="display: none;">
                            <label for="persona_id" class="form-label fw-bold">Persona involucrada</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">
                                    <i class="bi bi-person"></i>
                                </span>
                                <select name="persona_id" id="persona_id" class="form-select" required onchange="mostrarDetallesPersona()">
                                    <option value="">Seleccione una persona</option>
                                </select>
                            </div>
                            <div class="invalid-feedback">Por favor seleccione una persona</div>
                        </div>
                    </div>
                </div>
                
                <!-- Detalles de la persona y eventos relacionados (dinámico) -->
                <div class="card mb-4 shadow-sm border-0" id="tabla_detalles" style="display: none;">
                    <div class="card-header" style="background-color: #FFF3CD;">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-info-circle me-2 text-warning"></i>
                            <h5 class="mb-0 fw-bold text-warning">Detalles de la Persona y Eventos</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold">Información Personal</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm table-borderless">
                                        <tbody id="detalle_persona_body">
                                            <!-- Detalles personales cargados dinámicamente -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bi bi-clipboard2-pulse me-2 fs-4 text-danger"></i>
                                    <h6 class="fw-bold mb-0">Historial de Eventos</h6>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-sm table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Tipo</th>
                                                <th>Fecha</th>
                                                <th>Descripción</th>
                                            </tr>
                                        </thead>
                                        <tbody id="eventos_persona_body">
                                            <!-- Eventos relacionados cargados dinámicamente -->
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
                            <h5 class="mb-0 fw-bold text-success">Respuesta y Seguimiento</h5>
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
                            <div class="invalid-feedback">Por favor describa la respuesta</div>
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
                        
                        <div class="mb-3">
                            <label for="seguimiento" class="form-label fw-bold">Plan de Seguimiento</label>
                            <div class="input-group">
                                <span class="input-group-text bg-success text-white">
                                    <i class="bi bi-clipboard2-check"></i>
                                </span>
                                <textarea name="seguimiento" class="form-control" rows="3">{{ old('seguimiento') }}</textarea>
                            </div>
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
    
    /* Estilos para etiquetas de tipo de evento */
    .badge-accidente { background-color: #dc3545; }
    .badge-incidente { background-color: #fd7e14; }
    .badge-emergencia { background-color: #ffc107; color: #000; }
    .badge-acto-inseguro { background-color: #6c757d; }
    
    /* Efecto de transición para los elementos que aparecen/desaparecen */
    #persona_id_container, #tabla_detalles {
        transition: opacity 0.3s ease;
    }
    
    /* Estilo para la tabla de información personal */
    .table-borderless tbody tr td:first-child {
        font-weight: 600;
        color: #495057;
        width: 40%;
    }
</style>

<script>
    // Datos de personas y sus eventos relacionados
    const personasPorEvento = {
        accidente: @json($personasAccidentes ?? []),
        incidente: @json($personasIncidentes ?? []),
        emergencia: @json($personasEmergencias ?? []),
        acto_inseguro: @json($personasActosInseguros ?? [])
    };

    // Colores para cada tipo de evento
    const coloresTipos = {
        accidente: "#dc3545",      // Rojo
        incidente: "#fd7e14",      // Naranja
        emergencia: "#ffc107",     // Amarillo
        acto_inseguro: "#6c757d"   // Gris
    };

    // Función para mostrar personas según el tipo de evento seleccionado
    function mostrarPersonas() {
        const tipo = document.getElementById('tipo_evento').value;
        const select = document.getElementById('persona_id');
        const container = document.getElementById('persona_id_container');
        const tabla = document.getElementById('tabla_detalles');

        select.innerHTML = '<option value="">Seleccione una persona</option>';
        
        // Ocultar tabla de detalles si está visible
        if (tabla.style.display !== 'none') {
            tabla.style.opacity = '0';
            setTimeout(() => { tabla.style.display = 'none'; }, 300);
        }

        if (tipo && personasPorEvento[tipo]) {
            // Mostrar contenedor de selección de personas
            container.style.opacity = '0';
            container.style.display = 'block';
            setTimeout(() => { container.style.opacity = '1'; }, 10);
            
            // Agregar opciones de personas al select
            personasPorEvento[tipo].forEach(persona => {
                const option = document.createElement('option');
                option.value = persona.id;
                option.text = `${persona.nombre} ${persona.apellido} - ${persona.documento}`;
                option.setAttribute('data-events', JSON.stringify(persona.eventos));
                select.appendChild(option);
            });
        } else {
            container.style.opacity = '0';
            setTimeout(() => { container.style.display = 'none'; }, 300);
        }
    }

    // Función para mostrar detalles de la persona y sus eventos
    function mostrarDetallesPersona() {
        const tipo = document.getElementById('tipo_evento').value;
        const select = document.getElementById('persona_id');
        const selectedOption = select.options[select.selectedIndex];
        const personaId = parseInt(select.value);
        
        const tbodyPersona = document.getElementById('detalle_persona_body');
        const tbodyEventos = document.getElementById('eventos_persona_body');
        const tabla = document.getElementById('tabla_detalles');
        
        tbodyPersona.innerHTML = '';
        tbodyEventos.innerHTML = '';

        if (personaId && selectedOption.getAttribute('data-events')) {
            // Obtener datos de la persona y sus eventos
            const persona = personasPorEvento[tipo].find(p => p.id === personaId);
            const eventosPersona = JSON.parse(selectedOption.getAttribute('data-events'));
            
            // Mostrar tabla de detalles con transición
            tabla.style.opacity = '0';
            tabla.style.display = 'block';
            setTimeout(() => { tabla.style.opacity = '1'; }, 10);

            // Mostrar información personal
            if (persona) {
                const camposPersona = [
                    { label: 'Nombre completo', value: `${persona.nombre} ${persona.apellido}` },
                    { label: 'Documento', value: persona.documento },
                    { label: 'Cargo', value: persona.cargo || 'No especificado' },
                    { label: 'Área/Unidad', value: persona.area_unidad || 'No especificado' },
                    { label: 'Teléfono', value: persona.telefono || 'No especificado' },
                    { label: 'Correo electrónico', value: persona.email || 'No especificado' }
                ];

                camposPersona.forEach(campo => {
                    const row = document.createElement('tr');
                    const th = document.createElement('td');
                    th.textContent = campo.label;
                    const td = document.createElement('td');
                    td.textContent = campo.value;
                    
                    row.appendChild(th);
                    row.appendChild(td);
                    tbodyPersona.appendChild(row);
                });
            }

            // Mostrar eventos relacionados
            if (eventosPersona && eventosPersona.length > 0) {
                eventosPersona.forEach(evento => {
                    const row = document.createElement('tr');
                    
                    // Columna Tipo
                    const tdTipo = document.createElement('td');
                    const badge = document.createElement('span');
                    badge.className = `badge rounded-pill badge-${evento.tipo}`;
                    badge.textContent = evento.tipo.charAt(0).toUpperCase() + evento.tipo.slice(1).replace('_', ' ');
                    tdTipo.appendChild(badge);
                    
                    // Columna Fecha
                    const tdFecha = document.createElement('td');
                    tdFecha.textContent = new Date(evento.fecha).toLocaleDateString();
                    
                    // Columna Descripción
                    const tdDesc = document.createElement('td');
                    tdDesc.textContent = evento.descripcion ? evento.descripcion.substring(0, 50) + (evento.descripcion.length > 50 ? '...' : '') : 'Sin descripción';
                    
                    row.appendChild(tdTipo);
                    row.appendChild(tdFecha);
                    row.appendChild(tdDesc);
                    tbodyEventos.appendChild(row);
                });
            } else {
                const row = document.createElement('tr');
                const td = document.createElement('td');
                td.colSpan = 3;
                td.className = 'text-center text-muted';
                td.textContent = 'No hay eventos registrados para esta persona';
                row.appendChild(td);
                tbodyEventos.appendChild(row);
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