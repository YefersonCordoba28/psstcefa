<form action="/responder-accidente" method="POST">
    <!-- Campo oculto con el ID del accidente original -->
    <input type="hidden" name="accidente_id" value="{{ $accidente->id }}">

    <!-- Información del reporte original (solo lectura) -->
    <div class="form-group">
        <label>Reporte Original:</label>
        <div class="card bg-light p-3">
            <p><strong>Fecha y Hora:</strong> {{ $accidente->fecha_hora }}</p>
            <p><strong>Ubicación:</strong> {{ $accidente->ubicacion }}</p>
            <p><strong>Descripción:</strong> {{ $accidente->descripcion_accidente }}</p>
            <p><strong>Gravedad:</strong> {{ $accidente->gravedad }}</p>
            <p><strong>Creado por:</strong> {{ $accidente->creado_por }}</p>
        </div>
    </div>

    <!-- Campo para la respuesta -->
    <div class="form-group">
        <label for="respuesta">Respuesta al Reporte:</label>
        <textarea class="form-control" 
                  id="respuesta" 
                  name="respuesta" 
                  rows="5" 
                  required 
                  placeholder="Escriba aquí su respuesta al reporte..."></textarea>
    </div>

    <!-- Campo para estado del reporte (opcional) -->
    <div class="form-group">
        <label for="estado">Estado del Reporte:</label>
        <select class="form-control" 
                id="estado" 
                name="estado" 
                required>
            <option value="Pendiente">Pendiente</option>
            <option value="En Proceso">En Proceso</option>
            <option value="Resuelto">Resuelto</option>
            <option value="Rechazado">Rechazado</option>
        </select>
    </div>

    <!-- Campo para evidencias adicionales (opcional) -->
    <div class="form-group">
        <label for="evidencias_respuesta">Evidencias Adicionales (Opcional):</label>
        <input type="file" 
               class="form-control" 
               id="evidencias_respuesta" 
               name="evidencias_respuesta">
    </div>

    <!-- Campo para el respondedor -->
    <div class="form-group">
        <label for="respondido_por">Respondido por:</label>
        <input type="text" 
               class="form-control" 
               id="respondido_por" 
               name="respondido_por" 
               required>
    </div>

    <!-- Campo para fecha de respuesta (podría ser automático en el backend) -->
    <div class="form-group">
        <label for="fecha_respuesta">Fecha de Respuesta:</label>
        <input type="datetime-local" 
               class="form-control" 
               id="fecha_respuesta" 
               name="fecha_respuesta" 
               required>
    </div>

    <button type="submit" class="btn btn-primary">Enviar Respuesta</button>
</form>