@extends('instructor.dashboard')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-center">Lista de Accidentes</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                            <h5 class="card-title m-0">Accidentes Registrados</h5>
                            <a href="{{ route('accidentes.create') }}" class="btn btn-primary btn-sm">
                                Registrar Nuevo
                            </a>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPersonalizado">
                                Registrar Persona Involucrada
                            </button>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped align-middle">
                                    <thead class="thead-dark bg-dark text-white">
                                        <tr>
                                            <th class="text-center" style="width: 5%;">IDENTIFICACIÓN</th>
                                            <th class="text-center" style="width: 15%;">Fecha y hora</th>
                                            <th class="text-center" style="width: 15%;">Área</th>
                                            <th class="text-center" style="width: 15%;">Tipo de lesión</th>
                                            <th class="text-center" style="width: 15%;">Tipo de riesgo</th>
                                            <th class="text-center" style="width: 15%;">Tipo de accidente</th>
                                            <th class="text-center" style="width: 10%;">Gravedad</th>
                                            <th class="text-center" style="width: 10%;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($accidentes as $accidente)
                                            <tr>
                                                <td class="text-center align-middle">{{ $accidente->id }}</td>
                                                <td class="align-middle text-center">{{ $accidente->fecha_hora }}</td>
                                                <td class="align-middle text-center">{{ $accidente->areaUnidadProductiva->nombre ?? 'N/A' }}</td>
                                                <td class="align-middle text-center">{{ $accidente->tipoLesion->nombre ?? 'N/A' }}</td>
                                                <td class="align-middle text-center">{{ $accidente->tipoRiesgo->nombre ?? 'N/A' }}</td>
                                                <td class="align-middle text-center">{{ $accidente->tipoAccidente->nombre ?? 'N/A' }}</td>
                                                <td class="align-middle text-center">
                                                    <span class="badge {{ $accidente->gravedad === 'leve' ? 'bg-success' : ($accidente->gravedad === 'moderada' ? 'bg-warning' : ($accidente->gravedad === 'grave' ? 'bg-danger' : 'bg-dark')) }}">
                                                        {{ ucfirst($accidente->gravedad) }}
                                                    </span>
                                                </td>
                                                <td class="text-center align-middle">
                                                    <button class="btn btn-success btn-sm editbtn"
                                                            data-id="{{ $accidente->id }}"
                                                            data-fecha_hora="{{ $accidente->fecha_hora }}"
                                                            data-area_unidad_productiva_id="{{ $accidente->area_unidad_productiva_id }}"
                                                            data-tipo_lesion_id="{{ $accidente->tipo_lesion_id }}"
                                                            data-tipo_riesgo_id="{{ $accidente->tipo_riesgo_id }}"
                                                            data-tipo_accidente_id="{{ $accidente->tipo_accidente_id }}"
                                                            data-descripcion="{{ $accidente->descripcion }}"
                                                            data-evidencia="{{ $accidente->evidencia }}"
                                                            data-gravedad="{{ $accidente->gravedad }}"
                                                            data-creado_por="{{ $accidente->creado_por }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editar">
                                                        Editar
                                                    </button>
                                                    <button class="btn btn-danger btn-sm deletebtn"
                                                            data-id="{{ $accidente->id }}"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#eliminar">
                                                        Eliminar
                                                    </button>
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

            {{-- Modal Editar --}}
            <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down modal-lg">
                    <form id="formEditar" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarLabel">Editar Accidente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row row-cols-1 row-cols-md-2 g-3">
                                    <div class="col">
                                        <label for="fecha_hora">Fecha y Hora</label>
                                        <input type="datetime-local" name="fecha_hora" id="edit-fecha_hora" class="form-control form-control-sm" required>
                                    </div>
                                    <div class="col">
                                        <label for="area_unidad_productiva_id">Área/Unidad Productiva</label>
                                        <select name="area_unidad_productiva_id" id="edit-area_unidad_productiva_id" class="form-control form-control-sm" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="tipo_lesion_id">Tipo de Lesión</label>
                                        <select name="tipo_lesion_id" id="edit-tipo_lesion_id" class="form-control form-control-sm" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($tiposLesion as $tipoLesion)
                                                <option value="{{ $tipoLesion->id }}">{{ $tipoLesion->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="tipo_riesgo_id">Tipo de Riesgo</label>
                                        <select name="tipo_riesgo_id" id="edit-tipo_riesgo_id" class="form-control form-control-sm" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($tiposRiesgo as $tipoRiesgo)
                                                <option value="{{ $tipoRiesgo->id }}">{{ $tipoRiesgo->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="tipo_accidente_id">Tipo de Accidente</label>
                                        <select name="tipo_accidente_id" id="edit-tipo_accidente_id" class="form-control form-control-sm" required>
                                            <option value="">Seleccione...</option>
                                            @foreach ($tiposAccidente as $tipoAccidente)
                                                <option value="{{ $tipoAccidente->id }}">{{ $tipoAccidente->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="gravedad">Gravedad</label>
                                        <select name="gravedad" id="edit-gravedad" class="form-control form-control-sm" required>
                                            <option value="leve">Leve</option>
                                            <option value="moderada">Moderada</option>
                                            <option value="grave">Grave</option>
                                            <option value="fatal">Fatal</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="descripcion">Descripción</label>
                                        <textarea name="descripcion" id="edit-descripcion" class="form-control form-control-sm" rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="evidencia">Evidencia</label>
                                        <textarea name="evidencia" id="edit-evidencia" class="form-control form-control-sm" rows="3"></textarea>
                                    </div>
                                    <div class="col">
                                        <label for="creado_por">Creado Por</label>
                                        <input type="text" name="creado_por" id="edit-creado_por" class="form-control form-control-sm" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Modal Eliminar --}}
            <div class="modal fade" id="eliminar" tabindex="-1" aria-labelledby="eliminarLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form id="formEliminar" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="eliminarLabel">Eliminar Accidente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de que deseas eliminar este accidente?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Modal Personalizado (contenido desde otro archivo Blade) --}}
            <div class="modal fade" id="modalPersonalizado" tabindex="-1" aria-labelledby="modalPersonalizadoLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                    <div class="container">
    <h2 class="mb-4">Registrar Persona Involucrada</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('personas_involucradas.store') }}" method="POST">
        @csrf

        {{-- Nombre --}}
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        {{-- Apellido --}}
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" name="apellido" class="form-control" value="{{ old('apellido') }}" required>
        </div>

        {{-- Cargo --}}
        <div class="mb-3">
            <label for="cargo_id" class="form-label">Cargo</label>
            <select name="cargo_id" class="form-control">
                <option value="">Seleccione un cargo</option>
                @foreach($cargos as $cargo)
                    <option value="{{ $cargo->id }}" {{ old('cargo_id') == $cargo->id ? 'selected' : '' }}>
                        {{ $cargo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Accidente --}}
        <div class="mb-3">
            <label for="accidente_id" class="form-label">Accidente</label>
            <select name="accidente_id" class="form-control">
                <option value="">Seleccione un accidente</option>
                @foreach($accidentes as $accidente)
                    <option value="{{ $accidente->id }}" {{ old('accidente_id') == $accidente->id ? 'selected' : '' }}>
                        Accidente #{{ $accidente->id }} - {{ \Illuminate\Support\Str::limit($accidente->descripcion, 30) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Registrar Persona</button>
    </form>
</div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.editbtn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    document.getElementById('formEditar').action = `/accidentes/${id}`;

                    document.getElementById('edit-fecha_hora').value = this.getAttribute('data-fecha_hora').replace(' ', 'T');
                    document.getElementById('edit-area_unidad_productiva_id').value = this.getAttribute('data-area_unidad_productiva_id');
                    document.getElementById('edit-tipo_lesion_id').value = this.getAttribute('data-tipo_lesion_id');
                    document.getElementById('edit-tipo_riesgo_id').value = this.getAttribute('data-tipo_riesgo_id');
                    document.getElementById('edit-tipo_accidente_id').value = this.getAttribute('data-tipo_accidente_id');
                    document.getElementById('edit-descripcion').value = this.getAttribute('data-descripcion') || '';
                    document.getElementById('edit-evidencia').value = this.getAttribute('data-evidencia') || '';
                    document.getElementById('edit-gravedad').value = this.getAttribute('data-gravedad');
                    document.getElementById('edit-creado_por').value = this.getAttribute('data-creado_por');
                });
            });

            document.querySelectorAll('.deletebtn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    document.getElementById('formEliminar').action = `/accidentes/${id}`;
                });
            });
        });
    </script>

    <style>
        .table {
            width: 100%;
            margin-bottom: 1rem;
            background-color: #fff;
        }

        .table th, .table td {
            padding: 0.75rem;
            vertical-align: middle;
            border: 1px solid #dee2e6;
        }

        .table th {
            font-weight: 600;
            white-space: normal;
            text-transform: uppercase;
        }

        .table td {
            white-space: normal;
            word-break: break-word;
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.4em 0.8em;
        }

        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.875rem;
        }

        .card {
            border-radius: 0.5rem;
            overflow: hidden;
        }

        @media (max-width: 992px) {
            .table-responsive {
                font-size: 0.9rem;
            }
            .table th, .table td {
                padding: 0.5rem;
            }
            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 768px) {
            .modal-content {
                font-size: 0.9rem;
            }
        }
    </style>
@endsection
