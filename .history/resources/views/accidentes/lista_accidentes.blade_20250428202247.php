@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-center">Lista de Accidentes Registrados</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">Accidentes</h5>
                        <div class="card-tools">
                            <a href="{{ route('accidentes.create') }}" class="btn btn-primary btn-sm">
                                Registrar Nuevo Accidente
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Fecha y Hora</th>
                                        <th class="text-center">Área/Unidad</th>
                                        <th class="text-center">Tipo de Lesión</th>
                                        <th class="text-center">Tipo de Riesgo</th>
                                        <th class="text-center">Tipo de Accidente</th>
                                        <th class="text-center">Gravedad</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($datos as $accidente)
                                        <tr>
                                            <td class="text-center align-middle">{{ $accidente->id }}</td>
                                            <td class="text-center align-middle">{{ $accidente->fecha_hora }}</td>
                                            <td class="align-middle">{{ $accidente->areaUnidadProductiva->nombre ?? '-' }}</td>
                                            <td class="align-middle">{{ $accidente->tipoLesion->nombre ?? '-' }}</td>
                                            <td class="align-middle">{{ $accidente->tipoRiesgo->nombre ?? '-' }}</td>
                                            <td class="align-middle">{{ $accidente->tipoAccidente->nombre ?? '-' }}</td>
                                            <td class="text-center align-middle">
                                                <span class="badge 
                                                    @if($accidente->gravedad == 'leve') bg-success
                                                    @elseif($accidente->gravedad == 'moderada') bg-warning
                                                    @elseif($accidente->gravedad == 'grave') bg-danger
                                                    @elseif($accidente->gravedad == 'fatal') bg-dark
                                                    @endif
                                                ">{{ ucfirst($accidente->gravedad) }}</span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <button class="btn btn-success btn-sm editbtn"
                                                        data-id="{{ $accidente->id }}"
                                                        data-fecha_hora="{{ $accidente->fecha_hora }}"
                                                        data-area="{{ $accidente->areaUnidadProductiva->id }}"
                                                        data-lesion="{{ $accidente->tipoLesion->id }}"
                                                        data-riesgo="{{ $accidente->tipoRiesgo->id }}"
                                                        data-accidente="{{ $accidente->tipoAccidente->id }}"
                                                        data-gravedad="{{ $accidente->gravedad }}">
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
                                            <td colspan="8" class="text-center">No hay accidentes registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
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

        {{-- Modal Editar --}}
<div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form id="formEditar" method="POST" action="{{ route('accidentes.update', $accidente->id) }}">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarLabel">Editar Accidente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    {{-- Fecha y Hora --}}
                    <div class="mb-3">
                        <label for="editFechaHora" class="form-label">Fecha y Hora</label>
                        <input type="datetime-local" name="fecha_hora" id="editFechaHora" class="form-control" value="{{ old('fecha_hora', $accidente->fecha_hora) }}">
                    </div>

                    {{-- Área/Unidad --}}
                    <div class="mb-3">
                        <label for="editArea" class="form-label">Área/Unidad</label>
                        <select name="area_unidad_productiva_id" id="editArea" class="form-select">
                            @foreach ($datos as $area)
                                <option value="{{ $area->id }}" @if($area->id == $accidente->areaUnidadProductiva->id) selected @endif>{{ $area->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tipo de Lesión --}}
                    <div class="mb-3">
                        <label for="editLesion" class="form-label">Tipo de Lesión</label>
                        <select name="tipo_lesion_id" id="editLesion" class="form-select">
                            @foreach ($datos as $lesion)
                                <option value="{{ $lesion->id }}" @if($lesion->id == $accidente->tipoLesion->id) selected @endif>{{ $lesion->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tipo de Riesgo --}}
                    <div class="mb-3">
                        <label for="editRiesgo" class="form-label">Tipo de Riesgo</label>
                        <select name="tipo_riesgo_id" id="editRiesgo" class="form-select">
                            @foreach ($datos as $riesgo)
                                <option value="{{ $riesgo->id }}" @if($riesgo->id == $accidente->tipoRiesgo->id) selected @endif>{{ $riesgo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tipo de Accidente --}}
                    <div class="mb-3">
                        <label for="editAccidente" class="form-label">Tipo de Accidente</label>
                        <select name="tipo_accidente_id" id="editAccidente" class="form-select">
                            @foreach ($tiposAccidente as $tipo)
                                <option value="{{ $tipo->id }}" @if($tipo->id == $accidente->tipoAccidente->id) selected @endif>{{ $tipo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Gravedad --}}
                    <div class="mb-3">
                        <label for="editGravedad" class="form-label">Gravedad</label>
                        <select name="gravedad" id="editGravedad" class="form-select">
                            <option value="leve" @if($accidente->gravedad == 'leve') selected @endif>Leve</option>
                            <option value="moderada" @if($accidente->gravedad == 'moderada') selected @endif>Moderada</option>
                            <option value="grave" @if($accidente->gravedad == 'grave') selected @endif>Grave</option>
                            <option value="fatal" @if($accidente->gravedad == 'fatal') selected @endif>Fatal</option>
                        </select>
                    </div>

                    {{-- Descripción --}}
                    <div class="mb-3">
                        <label for="editDescripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" id="editDescripcion" class="form-control">{{ old('descripcion', $accidente->descripcion) }}</textarea>
                    </div>

                    {{-- Evidencia --}}
                    <div class="mb-3">
                        <label for="editEvidencia" class="form-label">Evidencia</label>
                        <input type="text" name="evidencia" id="editEvidencia" class="form-control" value="{{ old('evidencia', $accidente->evidencia) }}">
                    </div>

                    {{-- Creado Por --}}
                    <div class="mb-3">
                        <label for="editCreadoPor" class="form-label">Creado Por</label>
                        <input type="text" name="creado_por" id="editCreadoPor" class="form-control" value="{{ old('creado_por', $accidente->creado_por) }}">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>

</section>

<script>
    document.querySelectorAll('.editbtn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const fecha_hora = this.dataset.fecha_hora;
            const area = this.dataset.area;
            const lesion = this.dataset.lesion;
            const riesgo = this.dataset.riesgo;
            const accidente = this.dataset.accidente;
            const gravedad = this.dataset.gravedad;

            document.getElementById('formEditar').action = `/accidentes/${id}`;
            document.getElementById('editFechaHora').value = fecha_hora;
            document.getElementById('editArea').value = area;
            document.getElementById('editLesion').value = lesion;
            document.getElementById('editRiesgo').value = riesgo;
            document.getElementById('editAccidente').value = accidente;
            document.getElementById('editGravedad').value = gravedad;

            new bootstrap.Modal(document.getElementById('modalEditar')).show();
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.deletebtn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                document.getElementById('formEliminar').action = `/accidentes/${id}`;
            });
        });
    });
</script>

<style>
    @media (max-width: 768px) {
        .table-responsive { font-size: 0.85rem; }
        .table th, .table td { padding: 0.5rem; white-space: nowrap; }
        .btn-sm { font-size: 0.75rem; padding: 0.25rem 0.5rem; }
        .card { margin: 0 0.5rem; }
        .modal-dialog { margin: 1rem; }
    }

    @media (max-width: 576px) {
        .table th, .table td { font-size: 0.75rem; padding: 0.3rem; }
        .btn-sm { font-size: 0.7rem; padding: 0.2rem 0.4rem; }
        .modal-content { font-size: 0.9rem; }
    }
</style>
@endsection
