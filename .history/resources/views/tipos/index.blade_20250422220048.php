<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tipos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Gestión de Tipos</h1>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <!-- Formulario para Tipo de Accidente -->
            <div class="col-md-4">
                <h3>Tipo de Accidente</h3>
                <form action="{{ route('tipos.storeTipoAccidente') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre_accidente" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre_accidente" name="nombre" value="{{ old('nombre') }}">
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>

                <h5 class="mt-3">Tipos Existentes</h5>
                <ul>
                    @foreach ($tipoAccidentes as $tipo)
                        <li>{{ $tipo->nombre }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Formulario para Tipo de Lesión -->
            <div class="col-md-4">
                <h3>Tipo de Lesión</h3>
                <form action="{{ route('tipos.storeTipoLesion') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre_lesion" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre_lesion" name="nombre" value="{{ old('nombre') }}">
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>

                <h5 class="mt-3">Tipos Existentes</h5>
                <ul>
                    @foreach ($tipoLesiones as $tipo)
                        <li>{{ $tipo->nombre }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Formulario para Tipo de Riesgo -->
            <div class="col-md-4">
                <h3>Tipo de Riesgo</h3>
                <form action="{{ route('tipos.storeTipoRiesgo') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre_riesgo" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre_riesgo" name="nombre" value="{{ old('nombre') }}">
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>

                <h5 class="mt-3">Tipos Existentes</h5>
                <ul>
                    @foreach ($tipoRiesgos as $tipo)
                        <li>{{ $tipo->nombre }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>