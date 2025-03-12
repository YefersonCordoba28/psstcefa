<form action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Fecha:</label>
    <input type="date" name="fecha" required>

    <label>Hora:</label>
    <input type="time" name="hora" required>

    <label>Ubicación:</label>
    <input type="text" name="ubicación" required>

    <label>Tipo de Evento:</label>
    <select name="tipo_evento">
        <option value="Accidente">Accidente</option>
        <option value="Incidente">Incidente</option>
        <option value="Emergencia">Emergencia</option>
    </select>

    <label>Descripción:</label>
    <textarea name="descripción_evento" required></textarea>

    <label>Personas Involucradas:</label>
    <textarea name="personas_involucradas"></textarea>

    <label>Testigos:</label>
    <textarea name="testigos"></textarea>

    <label>Evidencias (imagen):</label>
    <input type="file" name="evidencias">

    <label>Creado por:</label>
    <input type="text" name="creado_por" required>

    <button type="submit">Guardar Evento</button>
</form>
@foreach($eventos as $evento)
    <div style="margin-bottom: 20px;">
        <h3>{{ $evento->tipo_evento }} - {{ $evento->fecha }}</h3>
        <p>{{ $evento->descripción_evento }}</p>
        
        @if($evento->evidencias)
            <img src="{{ asset($evento->evidencias) }}" width="200">
        @else
            <p>No hay evidencia disponible.</p>
        @endif
    </div>
@endforeach