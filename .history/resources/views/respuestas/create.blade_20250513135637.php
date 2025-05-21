@extends('instructor.dashboard')

@section('content')
<style>
    .card.bg-dark {
        background: linear-gradient(135deg, #1a1a1a, #2c2c2c);
        border: 1px solid #17a2b8;
        transition: transform 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .form-control.bg-secondary, .form-select.bg-secondary {
        background: #343a40;
        border: 1px solid #17a2b8;
        color: #fff;
        transition: border-color 0.3s ease;
    }
    .form-control:focus, .form-select:focus {
        border-color: #00d4ff;
        box-shadow: 0 0 5px rgba(0, 212, 255, 0.5);
    }
    #tabla_detalles {
        animation: fadeIn 0.5s ease-in;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .table-dark th, .table-dark td {
        border-color: #17a2b8;
    }
    .btn-success {
        background-color: #28a745;
        border-color: #28a745;
        transition: background-color 0.3s ease;
    }
    .btn-success:hover {
        background-color: #218838;
    }
    .btn-outline-light {
        border-color: #fff;
        transition: background-color 0.3s ease;
    }
    .btn-outline-light:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
    .text-danger {
        font-size: 0.875rem;
    }
</style>

<div class="container mt-4">
    <div class="card bg-dark text-white shadow-lg rounded">
        <div class="card-header border-bottom border-info">
            <h3 class="text-info mb-0"><i class="bi bi-clipboard-check"></i> Registrar Respuesta a Evento</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('respuestas.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tipo_evento" class="form-label">Tipo de Evento</label>
                        <select name="tipo_evento" id="tipo_evento" class="form-select bg-secondary" required aria-label="Seleccionar tipo de evento">
                            <option value="">Seleccione un tipo</option>
                            <option value="accidente">Accidente</option>
                            <option value="incidente">Incidente</option>
                            <option value="emergencia">Emergencia</option>
                            <option value="acto_inseguro">Acto Inseguro</option>
                        </select>
                        @error('tipo_evento')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6" id="evento_id_container" style="display: none;">
                        <label for="evento_id" class="form-label">Seleccione el evento</label>
                        <select name="evento_id" id="evento_id" class="form-select bg-secondary" required aria-label="Seleccionar evento relacionado">
                            <option value="">Seleccione un evento</option>
                        </select>
                        @error('evento_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4" id="tabla_detalles" style="display: none;">
                    <h5 class="text-info"><i class="bi bi-info-circle"></i> Detalles del Evento</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-sm table-dark">
                            <tbody id="detalle_evento_body">
                                <!-- Filas dinámicas -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="respuesta" class="form-label">Respuesta</label>
                    <textarea name="respuesta" class="form-control bg-secondary text-white border-0" rows="3" aria-label="Descripción de la respuesta">{{ old('respuesta') }}</textarea>
                    @error('respuesta')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="acciones_tomadas" class="form-label">Acciones Tomadas</label>
                    <textarea name="acciones_tomadas" class="form-control bg-secondary text-white border-0" rows="3" aria-label="Acciones tomadas">{{ old('acciones_tomadas') }}</textarea>
                    @error('acciones_tomadas')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fecha_respuesta" class="form-label">Fecha de Respuesta</label>
                        <input type="datetime-local" name="fecha_respuesta" class="form-control bg-secondary text-white border-0" required aria-label="Fecha y hora de la respuesta">
                        @error('fecha_respuesta')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="respondido_por" class="form-label">Respondido por</label>
                        <input type="text" name="respondido_por" class="form-control bg-secondary text-white border-0" value="{{ old('respondido_por') }}" aria-label="Nombre de la persona que responde">
                        @error('respondido_por')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="bi bi-check-circle-fill"></i> Guardar Respuesta
                    </button>
                    <a href="{{ route('respuestas.index') }}" class="btn btn-outline-light px-4">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
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

    document.getElementById('tipo_evento').addEventListener('change', mostrarEventos);
    document.getElementById('evento_id').addEventListener('change', mostrarDetalles);

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
            select.focus();
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
                    campo.textContent = key.replaceAll('_', ' ').replace(/\b\w/g, c => c.toUpperCase());
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
                            valor.textContent = evento[key] ?? 'No disponible';
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
</script>
@endsection