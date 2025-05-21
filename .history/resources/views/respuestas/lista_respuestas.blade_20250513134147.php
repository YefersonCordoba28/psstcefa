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
                        <h5 class="card-title m-0">Respuestas Registradas a Eventos</h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('respuestas.create') }}" class="btn btn-primary btn-sm">
                                Registrar Nueva Respuesta
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <!-- Filtro por fecha -->
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

                        <!-- Tabla de respuestas -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped align-middle" id="respuestasTable">
                                <thead class="thead-dark bg-dark text-white">
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Tipo de Evento</th>
                                        <th class="text-center">Evento ID</th>
                                        <th class="text-center">Respuesta</th>
                                        <th class="text-center">Acciones Tomadas</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Respondido por</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($respuestas as $respuesta)
                                        <tr class="respuesta-row" data-fecha="{{ \Carbon\Carbon::parse($respuesta->fecha_respuesta)->format('Y-m-d') }}">
                                            <td class="text-center">{{ $respuesta->id }}</td>
                                            <td class="text-center text-capitalize">{{ $respuesta->tipo_evento }}</td>
                                            <td class="text-center">{{ $respuesta->evento_id }}</td>
                                            <td>{{ Str::limit($respuesta->respuesta, 50) }}</td>
                                            <td>{{ Str::limit($respuesta->acciones_tomadas, 50) }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($respuesta->fecha_respuesta)->format('Y-m-d H:i') }}</td>
                                            <td class="text-center">{{ $respuesta->respondido_por }}</td>
                                            <td class="text-center">
                                                <a href="" class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('respuestas.destroy', $respuesta->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Estás seguro de eliminar esta respuesta?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No hay respuestas registradas.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $respuestas->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  
</section>

<script>
    // Filtro por fecha (cliente)
    document.getElementById('searchForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const filtro = document.getElementById('fechaFilter').value;
        document.querySelectorAll('.respuesta-row').forEach(row => {
            const fecha = row.dataset.fecha;
            row.style.display = (!filtro || fecha === filtro) ? '' : 'none';
        });
    });

    document.getElementById('resetFilter').addEventListener('click', function() {
        document.getElementById('fechaFilter').value = '';
        document.querySelectorAll('.respuesta-row').forEach(row => row.style.display = '');
    });
</script>
@endsection
