@extends('layouts.master')

@section('title', 'Registrar Área de Unidad Productiva')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Registrar Área de Unidad Productiva</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('area_unidad_productivas.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nombre">Nombre del Área</label>
                            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" 
                                   value="{{ old('nombre') }}" required placeholder="Ej: Producción, Almacén, etc.">
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="descripcion">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror" 
                                      rows="3" placeholder="Descripción del área (opcional)">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Guardar</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>

            <!-- Lista de áreas existentes -->
            <div class="card shadow mt-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Áreas de Unidad Productiva Existentes</h5>
                </div>
                <div class="card-body">
                    @if ($areas->isEmpty())
                        <p>No hay áreas de unidad productiva registradas.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($areaUnidadProductiva as $area)
                                    <tr>
                                        <td>{{ $area->nombre }}</td>
                                        <td>{{ $area->descripcion ?? 'Sin descripción' }}</td>
                                        <td>
                                            <!-- Botón para editar (ruta ficticia, necesitarás crearla) -->
                                            <a href="{{ route('area_unidad_productiva.edit', $area->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                            <!-- Formulario para eliminar -->
                                            <form action="{{ route('area_unidad_productiva.destroy', $area->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta área?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection