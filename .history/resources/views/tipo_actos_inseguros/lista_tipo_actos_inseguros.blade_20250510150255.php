@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Lista de Tipos de Actos Inseguros</h4>
        <a href="{{ route('tipo_actos_inseguros.create') }}" class="btn btn-primary">+ Nuevo</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($datos as $tipo)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tipo->nombre }}</td>
                            <td>
                                <a href="{{ route('tipo_acto_inseguros.edit', $tipo->id) }}" class="btn btn-sm btn-warning">Editar</a>

                                <form action="{{ route('tipo_acto_inseguros.destroy', $tipo->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Está seguro de eliminar este tipo de acto inseguro?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No hay tipos de actos inseguros registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
