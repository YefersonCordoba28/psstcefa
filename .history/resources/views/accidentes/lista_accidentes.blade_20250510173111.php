@extends('instructor.dashboard')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <!-- Encabezado opcional -->
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white flex-wrap">
                        <h5 class="card-title m-0">Accidentes Registrados</h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('accidentes.create') }}" class="btn btn-primary btn-sm">Registrar Nuevo</a>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPersonalizado">Registrar Persona Involucrada</button>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <form id="searchForm">
                                    <div class="input-group">
                                        <select name="gravedad" id="gravedadFilter" class="form-control form-control-sm">
                                            <option value="">Busca por gravedad</option>
                                            <option value="leve">Leve</option>
                                            <option value="moderada">Moderada</option>
                                            <option value="grave">Grave</option>
                                            <option value="fatal">Fatal</option>
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
                            <table class="table table-bordered table-hover table-striped align-middle" id="accidentesTable">
                                <thead class="thead-dark bg-dark text-white">
                                    <tr>
                                        <th class="text-center">IDENTIFICACIÓN</th>
                                        <th class="text-center">Fecha y hora</th>
                                        <th class="text-center">Área</th>
                                        <th class="text-center">Tipo de lesión</th>
                                        <th class="text-center">Tipo de riesgo</th>
                                        <th class="text-center">Tipo de accidente</th>
                                        <th class="text-center">Gravedad</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($accidentes as $accidente)
                                        <tr class="accidente-row" data-gravedad="{{ $accidente->gravedad }}">
                                            <td class="text-center">{{ $accidente->id }}</td>
                                            <td class="text-center">{{ $accidente->fecha_hora }}</td>
                                            <td class="text-center">{{ $accidente->areaUnidadProductiva->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $accidente->tipoLesion->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $accidente->tipoRiesgo->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $accidente->tipoAccidente->nombre ?? 'N/A' }}</td>
                                            <td class="text-center">
                                                <span class="badge {{ $accidente->gravedad === 'leve' ? 'bg-success' : ($accidente->gravedad === 'moderada' ? 'bg-warning' : ($accidente->gravedad === 'grave' ? 'bg-danger' : 'bg-dark')) }}">
                                                    {{ ucfirst($accidente->gravedad) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('accidentes.edit', $accidente->id) }}" class="btn btn-success btn-sm">
                                                    <i class="fas fa-edit me-1"></i> Editar
                                                </a>
                                                <form action="{{ route('accidentes.destroy', $accidente->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este accidente?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash me-1"></i> Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-3">No hay accidentes registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('partials.modal_persona_involucrada') {{-- El modal debe ir aquí o incluido externamente --}}

    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchForm = document.getElementById('searchForm');
        const gravedadFilter = document.getElementById('gravedadFilter');
        const resetFilter = document.getElementById('resetFilter');
        const accidenteRows = document.querySelectorAll('.accidente-row');

        function filterTable() {
            const selectedGravedad = gravedadFilter.value.toLowerCase();

            accidenteRows.forEach(row => {
                const rowGravedad = row.getAttribute('data-gravedad').toLowerCase();
                row.style.display = selectedGravedad === '' || rowGravedad === selectedGravedad ? '' : 'none';
            });
        }

        searchForm.addEventListener('submit', function (e) {
            e.preventDefault();
            filterTable();
        });

        resetFilter.addEventListener('click', function () {
            gravedadFilter.value = '';
            filterTable();
        });
    });
</script>

<style>
    .input-group {
        margin-bottom: 1rem;
    }

    #gravedadFilter {
        max-width: 200px;
    }

    @media (max-width: 768px) {
        #gravedadFilter {
            max-width: 100%;
        }

        .input-group {
            flex-wrap: nowrap;
        }

        .input-group > .form-control,
        .input-group > .btn {
            flex: 1 1 auto;
        }
    }

    .btn:hover {
        transform: scale(1.02);
        transition: transform 0.2s ease-in-out;
    }

    .modal.fade .modal-dialog {
        transform: translateY(50px);
        transition: transform 0.4s ease-out, opacity 0.4s ease-out;
        opacity: 0;
    }

    .modal.fade.show .modal-dialog {
        transform: translateY(0);
        opacity: 1;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        transition: all 0.3s ease-in-out;
    }
</style>

@endsection
