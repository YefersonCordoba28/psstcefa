@extends('instructor.dashboard')

@section('content')
<div class="content-header">
    <div class="container-fluid">
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white flex-wrap">
                        <h5 class="card-title m-0">Emergencias Registradas</h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('emergencias.create') }}" class="btn btn-primary btn-sm">
                                Registrar Nuevo
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <!-- Formulario de búsqueda por fecha -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <form id="searchForm" class="form-inline">
                                    <div class="input-group">
                                        <input type="date" name="fecha" id="fechaFilter" class="form-control form-control-sm">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fas fa-search"></i> Buscar
                                        </button>
                                        <button type="button" id="resetFilter" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-undo"></i> Mostrar Todos
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped align-middle" id="emergenciasTable">
                                <thead class="thead-dark bg-dark text-white">
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Fecha y Hora</th>
                                        <th class="text-center">Área</th>
                                        <th class="text-center">Tipo de Emergencia</th>
                                        <th class="text-center">Tipo de Riesgo</th>
                                        <th class="text-center">Gravedad</th>
                                        <th class="text-center">Creado por</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($emergencias as $emergencia)
                                        <tr class="emergencia-row" data-fecha="{{ \Carbon\Carbon::parse($emergencia->fecha_hora)->format('Y-m-d') }}">
                                            <td class="text-center">{{ $emergencia->id }}</td>
                                            <td class="text-center">{{ $emergencia->fecha_hora }}</td>
                                            <td class="text-center">{{ $emergencia->areaUnidadProductiva->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $emergencia->tipoEmergencia->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $emergencia->tipoRiesgo->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">
                                                <span class="badge 
                                                    {{ $emergencia->gravedad === 'leve' ? 'bg-success' : 
                                                       ($emergencia->gravedad === 'moderada' ? 'bg-warning' : 
                                                       ($emergencia->gravedad === 'grave' ? 'bg-danger' : 'bg-dark')) }}">
                                                    {{ ucfirst($emergencia->gravedad) }}
                                                </span>
                                            </td>
                                            <td class="text-center">{{ $emergencia->creado_por }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('emergencias.edit', $emergencia->id) }}" class="btn btn-success btn-sm">
                                                    Editar
                                                </a>
                                                <form action="{{ route('emergencias.destroy', $emergencia->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta emergencia?')">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-3">No hay emergencias registradas.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchForm = document.getElementById('searchForm');
            const fechaFilter = document.getElementById('fechaFilter');
            const resetFilter = document.getElementById('resetFilter');
            const emergenciaRows = document.querySelectorAll('.emergencia-row');

            function filterTable() {
                const selectedFecha = fechaFilter.value;
                emergenciaRows.forEach(row => {
                    const rowFecha = row.getAttribute('data-fecha');
                    row.style.display = (!selectedFecha || rowFecha === selectedFecha) ? '' : 'none';
                });
            }

            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                filterTable();
            });

            resetFilter.addEventListener('click', function() {
                fechaFilter.value = '';
                filterTable();
            });
        });
    </script>
</section>
@endsection
