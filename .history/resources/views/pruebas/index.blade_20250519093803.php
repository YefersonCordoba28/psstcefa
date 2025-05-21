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

<form action="{{prueba.index}}" metod="pot">
@csrf
@method('post')
<label for="">tabla</label>
<select name="tabla" id="">
    <option value="accidente">accidente</option>
    <option value="incidente">incidente</option>
    <option value="emergencia">emergencia</option>
<label for="">evento</label>

</form>