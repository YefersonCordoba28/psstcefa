<form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
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
