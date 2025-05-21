<form action="{{prueba.index}}" metod="pot">
@csrf
@method('post')
<label for="">tabla</label>
<select name="tabla" id="">
    <option value="respuestas">respuestas</option>
    <option value="eventos">eventos</option>
    <option value="pruebas">pruebas</option>
<label for="">evento</label>

</form>