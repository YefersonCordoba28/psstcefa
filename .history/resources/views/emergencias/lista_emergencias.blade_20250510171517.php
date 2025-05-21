@extends('instructor.dashboard')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <!-- Puedes agregar encabezado si lo necesitas -->
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white flex-wrap">
                        <h5 class="card-title m-0"><i class="fas fa-list me-2"></i>Accidentes Registrados</h5>
                        <a href="{{ route('accidentes.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i>Registrar Accidente
                        </a>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped align-middle" id="tablaAccidentes">
                                <thead class="thead-dark bg-dark text-white">
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Fecha y Hora</th>
                                        <th class="text-center">Área</th>
                                        <th class="text-center">Lesión</th>
                                        <th class="text-center">Riesgo</th>
                                        <th class="text-center">Tipo</th>
                                        <th class="text-center">Gravedad</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($emergencias as $accidente)
                                        <tr>
                                            <td class="text-center">{{ $accidente->id }}</td>
                                            <td class="text-center">{{ $accidente->fecha_hora }}</td>
                                            <td class="text-center">{{ $accidente->areaUnidadProductiva->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $accidente->tipoLesion->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $accidente->tipoRiesgo->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $accidente->tipoAccidente->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">
                                                <span class="badge 
                                                    @if($accidente->gravedad == 'leve') bg-success 
                                                    @elseif($accidente->gravedad == 'moderada') bg-warning 
                                                    @elseif($accidente->gravedad == 'grave') bg-danger 
                                                    @else bg-dark 
                                                    @endif">
                                                    {{ ucfirst($accidente->gravedad) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('accidentes.', $accidente->id) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('accidentes.edit', $accidente->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('accidentes.destroy', $accidente->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('¿Desea eliminar este accidente?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No hay accidentes registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- Paginación (si aplica) -->
                        <div class="mt-3">
                            {{ $accidentes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</section>

@endsection
