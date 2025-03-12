<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Reporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .btn-primary {
            width: 100%;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
        }
        .form-label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Reporte de Accidente</h2>
        <form action="#" method="post">
            <div class="form-group">
                <label for="nombre" class="form-label">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="fecha" class="form-label">Fecha del Incidente</label>
                <input type="date" id="fecha" name="fecha" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="lugar" class="form-label">Lugar del Incidente</label>
                <input type="text" id="lugar" name="lugar" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="descripcion" class="form-label">Descripción del Incidente</label>
                <textarea id="descripcion" name="descripcion" rows="5" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Reporte</button>
        </form>
    </div>
</body>
</html>
