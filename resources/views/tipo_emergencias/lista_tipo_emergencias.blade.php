@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-center">Lista de Tipos de Emergencias</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Tipos de Emergencias</h5>
                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#crear">
                            Registrar Nuevo
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover align-middle text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre del Tipo</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($datos as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td class="text-start">{{ $item->nombre }}</td>
                                            <td>
                                                <button class="btn btn-success btn-sm editbtn"
                                                        data-id="{{ $item->id }}"
                                                        data-nombre="{{ $item->nombre }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editar">
                                                    Editar
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger btn-sm deletebtn"
                                                        data-id="{{ $item->id }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#eliminar">
                                                    Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4">No hay tipos de emergencias registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Crear --}}
        <div class="modal fade" id="crear" tabindex="-1" aria-labelledby="crearLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form action="{{ route('tipo_emergencias.store') }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="crearLabel">Registrar Tipo de Emergencia</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal Editar --}}
        <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <form id="formEditar" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header bg-warning">
                            <h5 class="modal-title" id="editarLabel">Editar Tipo de Emergencia</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="edit-nombre">Nombre:</label>
                                <input type="text" name="nombre" id="edit-nombre" class="form-control" required>
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
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="eliminarLabel">Eliminar Tipo de Emergencia</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar este tipo de emergencia?
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
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/tipo_emergencias/${id}`;
                document.getElementById('edit-nombre').value = this.getAttribute('data-nombre');
            });
        });

        document.querySelectorAll('.deletebtn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                document.getElementById('formEliminar').action = `/tipo_emergencias/${id}`;
            });
        });
    });
</script>

<style>
    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.9rem;
        }
        .table th, .table td {
            padding: 0.5rem;
            white-space: nowrap;
        }
        .btn-sm {
            font-size: 0.8rem;
            padding: 0.3rem 0.6rem;
        }
        .modal-dialog {
            margin: 1rem;
        }
    }

    @media (max-width: 576px) {
        .table th, .table td {
            font-size: 0.75rem;
            padding: 0.3rem;
        }
        .btn-sm {
            font-size: 0.7rem;
            padding: 0.2rem 0.4rem;
        }
        .modal-content {
            font-size: 0.9rem;
        }
    }
</style>
@endsection
