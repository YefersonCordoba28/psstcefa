@extends('instructor.dashboard')

@section('content')
<div class="container mt-5">
    <div class="card bg-dark text-white shadow-lg rounded-4">
        <div class="card-header bg-black text-info">
            <h3 class="mb-0">Registrar Respuesta a Evento</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('respuestas.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="tipo_evento" class="form-label text-info">Tipo de Evento</label>
                    <select name="tipo_evento" id="tipo_evento" class="form-select bg-dark text-white border-info" required onchange="mostrarEventos()">
                        <option value="">Seleccione un tipo</option>
                        <option value="accidente">Accidente</option>
                        <option value="incidente">Incidente</option>
                        <option value="emergencia">Emergencia</option>
                        <option value="acto_inseguro">Acto Inseguro</option>
                    </select>
                </div>

                <div class="mb-3" id="evento_id_container" style="display: none;">
                    <label for="evento_id" class="form-label text-info">Seleccione el Evento</label>
                    <select name="evento_id" id="evento_id" class="form-select bg-dark text-white border-info" required onchange="mostrarDetalles()">
                        <option value="">Seleccione un evento</option>
                    </select>
                </div>

                <div class="mb-4" id="tabla_detalles" style="display: none;">
                    <h5 class="text-info">Detalles del Evento</h5>
                    <div class="table-responsive">
                        <table class="table table-dark table-bordered border-info rounded">
                            <tbody id="detalle_evento_body"></tbody>
                        </table>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="respuesta" class="form-label text-info">Respuesta</label>
                    <textarea name="respuesta" class="form-control bg-dark text-white border-info" rows="3">{{ old('respuesta') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="acciones_tomadas" class="form-label text-info">Acciones Tomadas</label>
                    <textarea name="acciones_tomadas" class="form-control bg-dark text-white border-info" rows="3">{{ old('acciones_tomadas') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="fecha_respuesta" class="form-label text-info">Fecha de Respuesta</label>
                    <input type="datetime-local" name="fecha_respuesta" class="form-control bg-dark text-white border-info" required>
                </div>

                <div class="mb-3">
                    <label for="respondido_por" class="form-label text-info">Respondido por</label>
                    <input type="text" name="respondido_por" class="form-control bg-dark text-white border-info" value="{{ old('respondido_por') }}">
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-outline-success px-4">Guardar Respuesta</button>
                    <a href="{{ route('respuestas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
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
                    campo.textContent = key.replaceAll('_', ' ').toUpperCase();
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
</script>
@endsection
