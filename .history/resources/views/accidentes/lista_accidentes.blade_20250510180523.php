@extends('instructor.dashboard')

@section('content')
<div class="container py-4">
    <div class="card shadow border-0">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Lista de Accidentes</h5>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            <!-- Tabla de Accidentes -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha y Hora</th>
                        <th>Área</th>
                        <th>Lesión</th>
                        <th>Riesgo</th>
                        <th>Accidente</th>
                        <th>Gravedad</th>
                        <th>Creado por</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accidentes as $accidente)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $accidente->fecha_hora }}</td>
                            <td>{{ $accidente->areaUnidadProductiva->nombre }}</td>
                            <td>{{ $accidente->tipoLesion->nombre }}</td>
                            <td>{{ $accidente->tipoRiesgo->nombre }}</td>
                            <td>{{ $accidente->tipoAccidente->nombre }}</td>
                            <td>{{ ucfirst($accidente->gravedad) }}</td>
                            <td>{{ $accidente->creado_por }}</td>
                            <td>
                                <!-- Botón de Editar -->
                                <a href="{{ route('accidentes.edit', $accidente->id) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <!-- Botón de Eliminar -->
                                <form action="{{ route('accidentes.destroy', $accidente->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este accidente?');">
                                        <i class="fas fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
