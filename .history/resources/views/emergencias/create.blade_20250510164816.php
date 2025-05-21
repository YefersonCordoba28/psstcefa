<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Emergencia</title>
    <!-- Agregar Bootstrap para diseño -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <div class="container mt-5">
        <h2>Registrar Emergencia</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('emergencia.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="fecha_hora" class="form-label">Fecha y Hora de Emergencia</label>
                <input type="datetime-local" class="form-control" id="fecha_hora" name="fecha_hora" required>
            </div>

            <div class="mb-3">
                <label for="area_unidad_productiva_id" class="form-label">Área o Unidad Productiva</label>
                <select class="form-control" id="area_unidad_productiva_id" name="area_unidad_productiva_id" required>
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tipo_emergencia_id" class="form-label">Tipo de Emergencia</label>
                <select class="form-control" id="tipo_emergencia_id" name="tipo_emergencia_id" required>
                    @foreach($tiposEmergencia as $tipoEmergencia)
                        <option value="{{ $tipoEmergencia->id }}">{{ $tipoEmergencia->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="tipo_riesgo_id" class="form-label">Tipo de Riesgo</label>
                <select class="form-control" id="tipo_riesgo_id" name="tipo_riesgo_id" required>
                    @foreach($tiposRiesgo as $tipoRiesgo)
                        <option value="{{ $tipoRiesgo->id }}">{{ $tipoRiesgo->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="evidencia" class="form-label">Evidencia</label>
                <textarea class="form-control" id="evidencia" name="evidencia" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="gravedad" class="form-label">Gravedad</label>
                <select class="form-control" id="gravedad" name="gravedad" required>
                    <option value="leve">Leve</option>
                    <option value="moderada">Moderada</option>
                    <option value="grave">Grave</option>
                    <option value="fatal">Fatal</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="creado_por" class="form-label">Creado por</label>
                <input type="text" class="form-control" id="creado_por" name="creado_por" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar Emergencia</button>
        </form>
    </div>
</body>
</html>
