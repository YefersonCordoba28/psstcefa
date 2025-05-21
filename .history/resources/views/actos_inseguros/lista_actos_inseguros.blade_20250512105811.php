@extends('instructor.dashboard')

@section('content')

<div class="content-header">
    <div class="container-fluid"></div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white flex-wrap">
                        <h5 class="card-title m-0">Actos Inseguros Registrados</h5>
                        <a href="{{ route('actos_inseguros.create') }}" class="btn btn-primary btn-sm">
                            Registrar Nuevo
                        </a>
                    </div>

                    <div class="card-body p-4">
                        <!-- Filtro por gravedad -->
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <form id="searchForm">
                                    <div class="input-group">
                                        <select name="gravedad" id="gravedadFilter" class="form-control form-control-sm">
                                            <option value="">Buscar por gravedad</option>
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

                        <!-- Tabla de actos inseguros -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped align-middle" id="actosInsegurosTable">
                                <thead class="thead-dark bg-dark text-white">
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Fecha y Hora</th>
                                        <th class="text-center">Área</th>
                                        <th class="text-center">Tipo de Acto</th>
                                        <th class="text-center">Tipo de Riesgo</th>
                                        <th class="text-center">Descripción</th>
                                        <th class="text-center">Gravedad</th>
                                        <th class="text-center">Evidencia</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($actosInseguros as $acto)
                                        <tr data-gravedad="{{ $acto->gravedad }}">
                                            <td class="text-center">{{ $acto->id }}</td>
                                            <td class="text-center">{{ $acto->fecha_hora }}</td>
                                            <td class="text-center">{{ $acto->areaUnidadProductiva->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $acto->tipoActoInseguro->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $acto->tipoRiesgo->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">{{ Str::limit($acto->descripcion, 40) }}</td>
                                            <td class="text-center">
                                                <span class="badge 
                                                    {{ $acto->gravedad === 'leve' ? 'bg-success' : 
                                                       ($acto->gravedad === 'moderada' ? 'bg-warning' : 'bg-danger') }}">
                                                    {{ ucfirst($acto->gravedad) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if($acto->evidencia)
                                                    <img src="{{ asset('img_actos_inseguros/' . basename($acto->evidencia)) }}"
                                                         alt="Evidencia"
                                                         class="img-thumbnail"
                                                         style="max-width: 100px; max-height: 100px;">
                                                @else
                                                    <span class="text-muted">Sin evidencia</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('actos_inseguros.edit', $acto->id) }}" class="btn btn-success btn-sm">
                                                    Editar
                                                </a>
                                                <form action="{{ route('actos_inseguros.destroy', $acto->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este acto inseguro?')">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-3">No hay actos inseguros registrados.</td>
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

</section>

@endsection
