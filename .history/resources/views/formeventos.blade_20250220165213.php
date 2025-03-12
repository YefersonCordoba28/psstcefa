@extends('layouts/master')


@section('tituloPagina', 'Registro de Evento')





<form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data" class="p-6 bg-gray-800 text-white rounded-lg shadow-md">
    @csrf

    <!-- Fecha -->
    <div class="mb-4">
        <label for="fecha" class="block text-sm font-medium">Fecha:</label>
        <input type="date" name="fecha" id="fecha" class="mt-1 p-2 w-full bg-gray-700 rounded" required>
    </div>

    <!-- Hora -->
    <div class="mb-4">
        <label for="hora" class="block text-sm font-medium">Hora:</label>
        <input type="time" name="hora" id="hora" class="mt-1 p-2 w-full bg-gray-700 rounded" required>
    </div>

    <!-- Ubicación -->
    <div class="mb-4">
        <label for="ubicación" class="block text-sm font-medium">Ubicación:</label>
        <input type="text" name="ubicación" id="ubicación" class="mt-1 p-2 w-full bg-gray-700 rounded" required>
    </div>

    <!-- Tipo de Evento -->
    <div class="mb-4">
        <label for="tipo_evento" class="block text-sm font-medium">Tipo de Evento:</label>
        <select name="tipo_evento" id="tipo_evento" class="mt-1 p-2 w-full bg-gray-700 rounded" required>
            <option value="">Selecciona un tipo</option>
            <option value="Accidente">Accidente</option>
            <option value="Incidente">Incidente</option>
            <option value="Emergencia">Emergencia</option>
        </select>
    </div>

    <!-- Descripción del Evento -->
    <div class="mb-4">
        <label for="descripción_evento" class="block text-sm font-medium">Descripción del Evento:</label>
        <textarea name="descripción_evento" id="descripción_evento" rows="4" class="mt-1 p-2 w-full bg-gray-700 rounded" required></textarea>
    </div>

    <!-- Personas Involucradas -->
    <div class="mb-4">
        <label for="personas_involucradas" class="block text-sm font-medium">Personas Involucradas:</label>
        <textarea name="personas_involucradas" id="personas_involucradas" rows="3" class="mt-1 p-2 w-full bg-gray-700 rounded"></textarea>
    </div>

    <!-- Testigos -->
    <div class="mb-4">
        <label for="testigos" class="block text-sm font-medium">Testigos:</label>
        <textarea name="testigos" id="testigos" rows="3" class="mt-1 p-2 w-full bg-gray-700 rounded"></textarea>
    </div>

    <!-- Evidencias -->
    <div class="mb-4">
        <label for="evidencias" class="block text-sm font-medium">Subir Evidencias (imagen):</label>
        <input type="file" name="evidencias" id="evidencias" class="mt-1 p-2 w-full bg-gray-700 rounded" accept="image/*">
    </div>

    <!-- Creado por (autenticado) -->
    <input type="hidden" name="creado_por" value="{{ auth()->user()->name }}">

    <!-- Botón -->
    <div class="text-center">
        <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-white font-semibold">
            Registrar Evento
        </button>
    </div>
</form>

