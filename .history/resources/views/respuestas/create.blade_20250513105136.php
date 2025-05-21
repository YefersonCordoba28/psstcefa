@extends('instructor.dashboaedrd')

@section('content')
<div class="container mt-4 text-white">
    <h2 class="text-info">Registrar Respuesta a Evento</h2>

    <form action="{{ route('respuestas.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="tipo_evento">Tipo de Evento</label>
            <select name="tipo_evento" id="tipo_evento" class="form-control" required onchange="mostrarEventos()">
                <option value="">Seleccione un tipo</option>
                <option value="accidente">Accidente</option>
                <option value="incidente">Incidente</option>
                <option value="emergencia">Emergencia</option>
                <option value="acto_inseguro">Acto Inseguro</option>
            </select>
        </div>

        <div class="form-group mb-3" id="evento_id_container" style="display: none;">
            <label for="evento_id">Seleccione el evento</label>
            <select name="evento_id" id="evento_id" class="form-control" required>
                <option value="">Seleccione un evento</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="respuesta">Respuesta</label>
            <textarea name="respuesta" class="form-control" rows="3">{{ old('respuesta') }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="acciones_tomadas">Acciones Tomadas</label>
            <textarea name="acciones_tomadas" class="form-control" rows="3">{{ old('acciones_tomadas') }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="fecha_respuesta">Fecha de Respuesta</label>
            <input type="datetime-local" name="fecha_respuesta" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="respondido_por">Respondido por</label>
            <input type="text" name="respondido_por" class="form-control" value="{{ old('respondido_por') }}">
        </div>

        <button type="submit" class="btn btn-success">Guardar Respuesta</button>
        <a href="{{ route('respuestas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    const eventos = {
        accidente: @json($accidentes),
        incidente: @json($incidentes),
        emergencia: @json($emergencias),
        acto_inseguro: @json($actos)
    };

    function mostrarEventos() {
        const tipo = document.getElementById('tipo_evento').value;
        const select = document.getElementById('evento_id');
        const container = document.getElementById('evento_id_container');

        select.innerHTML = '<option value="">Seleccione un evento</option>';

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
</script>
@endsection
