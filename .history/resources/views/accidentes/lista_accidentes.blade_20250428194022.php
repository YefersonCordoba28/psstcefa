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
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title m-0">Accidentes Registrados</h5>
                        <div class="card-tools">
                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#crearAccidente">
                                Registrar Nuevo
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th>Fecha y Hora</th>
                                        <th>Área / Unidad</th>
                                        <th>Tipo de Lesión</th>
                                        <th>Tipo de Riesgo</th>
                                        <th>Tipo de Accidente</th>
                                        <th>Gravedad</th>
                                        <th class="text-center">Editar</th>
                                        <th class="text-center">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($datos as $accidente)
                                        <tr>
                                            <td class="text-center align-middle">{{ $accidente->id }}</td>
                                            <td>{{ $accidente->fecha_hora }}</td>
                                            <td>{{ $accidente->areaUnidadProductiva->nombre ?? '' }}</td>
                                            <td>{{ $accidente->tipoLesion->nombre ?? '' }}</td>
                                            <td>{{ $accidente->tipoRiesgo->nombre ?? '' }}</td>
                                            <td>{{ $accidente->tipoAccidente->nombre ?? '' }}</td>
                                            <td>{{ ucfirst($accidente->gravedad) }}</td>
                                            <td class="text-center align-middle">
                                                <button class="btn btn-success btn-sm editAccidenteBtn"
                                                        data-id="{{ $accidente->id }}"
                                                        data-fecha_hora="{{ $accidente->fecha_hora }}"
                                                        data-area_id="{{ $accidente->area_unidad_productiva_id }}"
                                                        data-lesion_id="{{ $accidente->tipo_lesion_id }}"
                                                        data-riesgo_id="{{ $accidente->tipo_riesgo_id }}"
                                                        data-accidente_id="{{ $accidente->tipo_accidente_id }}"
                                                        data-descripcion="{{ $accidente->descripcion }}"
                                                        data-evidencia="{{ $accidente->evidencia }}"
                                                        data-gravedad="{{ $accidente->gravedad }}"
                                                        data-creado_por="{{ $accidente->creado_por }}"
                                                        data-bs-toggle="modal" data-bs-target="#editarAccidente">
                                                    Editar
                                                </button>
                                            </td>
                                            <td class="text-center align-middle">
                                                <button class="btn btn-danger btn-sm deleteAccidenteBtn"
                                                        data-id="{{ $accidente->id }}"
                                                        data-bs-toggle="modal" data-bs-target="#eliminarAccidente">
                                                    Eliminar
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">No hay accidentes registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Crear Accidente --}}
        @include('accidentes.create')

        {{-- Modal Editar Accidente --}}
        @include('accidentes.modales.editar')

        {{-- Modal Eliminar Accidente --}}
        @include('accidentes.modales.eliminar')

    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Modal Editar
        document.querySelectorAll('.editAccidenteBtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEditarAccidente').action = `/accidentes/${id}`;

                document.getElementById('edit-fecha_hora').value = this.getAttribute('data-fecha_hora');
                document.getElementById('edit-area_unidad_productiva_id').value = this.getAttribute('data-area_id');
                document.getElementById('edit-tipo_lesion_id').value = this.getAttribute('data-lesion_id');
                document.getElementById('edit-tipo_riesgo_id').value = this.getAttribute('data-riesgo_id');
                document.getElementById('edit-tipo_accidente_id').value = this.getAttribute('data-accidente_id');
                document.getElementById('edit-descripcion').value = this.getAttribute('data-descripcion');
                document.getElementById('edit-evidencia').value = this.getAttribute('data-evidencia');
                document.getElementById('edit-gravedad').value = this.getAttribute('data-gravedad');
                document.getElementById('edit-creado_por').value = this.getAttribute('data-creado_por');
            });
        });

        // Modal Eliminar
        document.querySelectorAll('.deleteAccidenteBtn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('formEliminarAccidente').action = `/accidentes/${id}`;
            });
        });
    });
</script>
@endsection
