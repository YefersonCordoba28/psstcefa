<!-- if ($request->tabla_relacionada == "accidente") {
    $respuestas = RespuestaEvento::where('tipo_evento', 'accidente')
        ->where('evento_id', $request->id_reporte)
        ->latest()
        ->paginate(10);
} elseif ($request->tabla_relacionada == "incidente") {
    $respuestas = RespuestaEvento::where('tipo_evento', 'incidente')
        ->where('evento_id', $request->id_reporte)
        ->latest()
        ->paginate(10);
} elseif ($request->tabla_relacionada == "emergencia") {
    $respuestas = RespuestaEvento::where('tipo_evento', 'emergencia')
        ->where('evento_id', $request->id_reporte)
        ->latest()
        ->paginate(10);
} elseif ($request->tabla_relacionada == "acto_inseguro") {
    $respuestas = RespuestaEvento::where('tipo_evento', 'acto_inseguro')
        ->where('evento_id', $request->id_reporte)
        ->latest()
        ->paginate(10);
} -->
   <!-- $table->id();

            // Identificador del evento y tipo
            $table->unsignedBigInteger('evento_id'); // Puede ser un ID de accidente, incidente, etc.
            $table->enum('tipo_evento', ['accidente', 'incidente', 'emergencia', 'acto_inseguro']);

            // Campos del formulario
            $table->text('respuesta')->nullable();
            $table->text('acciones_tomadas')->nullable();
            $table->dateTime('fecha_respuesta')->nullable();
            $table->string('respondido_por')->nullable();

            $table->timestamps(); -->


<form action="{{route('prueba.respuesta')}}" metod="pot">
@csrf
@method('post')
<label for="">tabla</label>
<select name="tabla" id="">
    <option value="accidente">accidente</option>
    <option value="incidente">incidente</option>
    <option value="emergencia">emergencia</option>
        <option value="acto_inseguro">acto_inseguro</option>

</select>
<label for="">evento</label>
<select name="id_evento" id="">
@foreach ($eventos as $evento)
        <option value="{{ $evento->id }}">{{ $evento->tipo_evento }} - {{ $evento->respuesta }}</option>
    @endforeach
</select>

<input type="submit" name="" id="" value="Enviar">
</form>