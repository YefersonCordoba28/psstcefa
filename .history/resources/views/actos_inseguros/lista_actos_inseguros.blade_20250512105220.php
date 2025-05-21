@extends('instructor.dashboard')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <!-- Contenido adicional de encabezado si es necesario -->
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white flex-wrap">
                            <h5 class="card-title m-0">Actos Inseguros Registrados</h5>
                            <a href="{{ route('actos_inseguros.create') }}" class="btn btn-primary btn-sm">
                                Registrar Nuevo Acto Inseguro
                            </a>
                        </div>
                        <div class="card-body p-4">
                            <!-- Filtro por gravedad -->
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <form id="searchForm">
                                        <div class="input-group">
                                            <select name="gravedad" id="gravedadFilter" class="form-control form-control-sm">
                                                <option value="">Filtrar por gravedad</option>
                                                <option value="leve">Leve</option>
                                                <option value="moderada">Moderada</option>
                                                <option value="grave">Grave</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="fas fa-search"></i> Buscar
                                            </button>
                                            <button type="button" id="resetFilter" class="btn btn-secondary btn-sm">
                                                <i class="fas fa-undo"></i> Resetear
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped align-middle" id="actosInsegurosTable">
                                    <thead class="thead-dark bg-dark text-white">
                                        <tr>
                                            <th class="text-center">ID</
                                            <th class="text-center">ID</th>
                                            <th class="text-center">Usuario</th>
                                            <th class="text-center">Curso</th>
                                            <th class="text-center">Fecha</th>
                                            <th class="text-center">Descripción</th>
                                            <th class="text-center">Tipo de Acto</th>
                                            <th class="text-center">Gravedad</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($inseguros as $acto)
                                            <tr>
                                                <td class="text-center">{{ $acto->id }}</td>
                                                <td>{{ $acto->usuario }}</td>
                                                <td>{{ $acto->curso }}</td>
                                                <td>{{ $acto->fecha }}</td>
                                                <td>{{ $acto->descripcion }}</td>
                                                <td>{{ $acto->tipo_acto }}</td>
                                                <td class="text-center">
                                                    <span class="badge 
                                                        @if($acto->gravedad == 'leve') bg-success 
                                                        @elseif($acto->gravedad == 'moderada') bg-warning 
                                                        @elseif($acto->gravedad == 'grave') bg-danger 
                                                        @endif">
                                                        {{ ucfirst($acto->gravedad) }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('actos_inseguros.show', $acto->id) }}" class="btn btn-info btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('actos_inseguros.edit', $acto->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('actos_inseguros.destroy', $acto->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este acto inseguro?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">No hay actos inseguros registrados.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-3">
                                {{ $actosInseguros->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
