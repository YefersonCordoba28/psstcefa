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
                                                ">
                                                    {{ ucfirst($accidente->gravedad) }}
                                                </span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="{{ route('accidentes.edit', $accidente->id) }}" class="btn btn-success btn-sm">Editar</a>
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

    </div>
</section>

<script>
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
