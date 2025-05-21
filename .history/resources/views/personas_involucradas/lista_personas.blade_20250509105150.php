@extends('layouts.master')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-center">Personas Involucradas</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">Listado de Personas Involucradas</h5>
                        <div class="card-tools">
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#crearPersona">
                                Registrar Persona
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Apellido</th>
                                        <th class="text-center">Cargo</th>
                                        <th class="text-center">Accidente</th>
                                        <th class="text-center">Editar</th>
                                        <th class="text-center">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($datos as $persona)
                                        <tr>
                                            <td class="text-center">{{ $persona->id }}</td>
                                            <td>{{ $persona->nombre }}</td>
                                            <td>{{ $persona->apellido }}</td>
                                            <td>{{ $persona->cargo->nombre ?? 'N/A' }}</td>
                                            <td>#{{ $persona->accidente->id ?? 'N/A' }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-success btn-sm editbtn"
                                                        data-id="{{ $persona->id }}"
                                                        data-nombre="{{ $persona->nombre }}"
                                                        data-apellido="{{ $persona->apellido }}"
                                                        data-cargo_id="{{ $persona->cargo_id }}"
                                                        data-accidente_id="{{ $persona->accidente_id }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editarPersona">
                                                    Editar
                                                </button>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-danger btn-sm deletebtn"
                                                        data-id="{{ $persona->id }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#eliminarPersona">
                                                    Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No hay personas registradas.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Crear --}}
            <div class="modal fade" id="crearPersona" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <form action="{{ route('personas_involucradas.store') }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Registrar Persona</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body row g-3">
                                <div class="col-md-6">
                                    <label>Nombre:</label>
                                    <input type="text" name="nombre" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Apellido:</label>
                                    <input type="text" name="apellido" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Cargo:</label>
                                    <select name="cargo_id" class="form-select">
                                        <option value="">Seleccione un cargo</option>
                                        @foreach($datos as $cargo)
                                            <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Accidente:</label>
                                    <select name="accidente_id" class="form-select">
                                        <option value="">Seleccione un accidente</option>
                                        @foreach($datos as $accidente)
                                            <option value="{{ $accidente->id }}">
                                                Accidente #{{ $accidente->id }} - {{ \Illuminate\Support\Str::limit($accidente->descripcion, 30) }}
                                            </option>
                                        @endforeach
                                    </select>
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
            <div class="modal fade" id="editarPersona" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <form id="formEditar" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Persona</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body row g-3">
                                <div class="col-md-6">
                                    <label>Nombre:</label>
                                    <input type="text" name="nombre" id="edit-nombre" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Apellido:</label>
                                    <input type="text" name="apellido" id="edit-apellido" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Cargo:</label>
                                    <select name="cargo_id" id="edit-cargo_id" class="form-select">
                                        @foreach($cargos as $cargo)
                                            <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Accidente:</label>
                                    <select name="accidente_id" id="edit-accidente_id" class="form-select">
                                        @foreach($accidentes as $accidente)
                                            <option value="{{ $accidente->id }}">
                                                Accidente #{{ $accidente->id }} - {{ \Illuminate\Support\Str::limit($accidente->descripcion, 30) }}
                                            </option>
                                        @endforeach
                                    </select>
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
            <div class="modal fade" id="eliminarPersona" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <form id="formEliminar" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Eliminar Persona</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de que deseas eliminar esta persona involucrada?
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
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.editbtn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditar').action = `/personas_involucradas/${id}`;
                document.getElementById('edit-nombre').value = this.getAttribute('data-nombre');
                document.getElementById('edit-apellido').value = this.getAttribute('data-apellido');
                document.getElementById('edit-cargo_id').value = this.getAttribute('data-cargo_id');
                document.getElementById('edit-accidente_id').value = this.getAttribute('data-accidente_id');
            });
        });

        document.querySelectorAll('.deletebtn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                document.getElementById('formEliminar').action = `/personas_involucradas/${id}`;
            });
        });
    });
</script>
@endsection
