@extends('lacyou')

@section('content')
<div class="container mt-4 text-white">
    <h2 class="text-info">Lista de Respuestas a Eventos</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('respuestas.create') }}" class="btn btn-primary mb-3">Registrar Nueva Respuesta</a>

    <div class="table-responsive">
        <table class="table table-dark table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Tipo de Evento</th>
                    <th>ID Evento</th>
                    <th>Respuesta</th>
                    <th>Acciones Tomadas</th>
                    <th>Fecha de Respuesta</th>
                    <th>Respondido por</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($respuestas as $respuesta)
                    <tr>
                        <td>{{ $respuesta->id }}</td>
                        <td class="text-capitalize">{{ $respuesta->tipo_evento }}</td>
                        <td>{{ $respuesta->evento_id }}</td>
                        <td>{{ Str::limit($respuesta->respuesta, 50) }}</td>
                        <td>{{ Str::limit($respuesta->acciones_tomadas, 50) }}</td>
                        <td>{{ \Carbon\Carbon::parse($respuesta->fecha_respuesta)->format('d/m/Y H:i') }}</td>
                        <td>{{ $respuesta->respondido_por }}</td>
                        <td>
                            <a href="" class="btn btn-sm btn-info">Ver</a>
                            <a href="" class="btn btn-sm btn-warning">Editar</a>
                            <form action="" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta respuesta?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No hay respuestas registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación (si aplicas paginate() en el controlador) --}}
    <div class="mt-3">
        {{ $respuestas->links() }}
    </div>
</div>
@endsection
