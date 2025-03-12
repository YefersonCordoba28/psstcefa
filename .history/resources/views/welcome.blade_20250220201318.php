<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Reportes de SST - SENA</title>
  <!-- Fuentes -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- Estilos -->
  <style>
    /* Reset básico y estilos generales */
    html {
      line-height: 1.15;
      -webkit-text-size-adjust: 100%;
    }
    body {
      margin: 0;
      font-family: 'Nunito', sans-serif;
      background-color: #f7fafc;
      color: #1a202c;
    }
    /* Contenedor central */
    .container {
      max-width: 720px;
      margin: 0 auto;
      padding: 2rem;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }
    /* Tarjeta de bienvenida */
    .card {
      background: #fff;
      border-radius: 0.5rem;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
      padding: 2rem;
      text-align: center;
    }
    .card h1 {
      font-size: 2.25rem;
      font-weight: 700;
      margin-bottom: 1rem;
    }
    .card p {
      font-size: 1.125rem;
      margin-bottom: 1rem;
      line-height: 1.6;
    }
    /* Botón de acción */
    .btn {
      display: inline-block;
      padding: 0.75rem 1.5rem;
      background: #3182ce;
      color: #fff;
      border-radius: 0.375rem;
      text-decoration: none;
      transition: background 0.2s ease;
      font-size: 1rem;
      font-weight: 600;
    }
    .btn:hover {
      background: #2b6cb0;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <h1>Bienvenido al Sistema de Reportes de SST</h1>
      <p><strong>SENA</strong></p>
      <p>
        Este sistema ha sido desarrollado para la gestión integral de reportes relacionados con la 
        Seguridad y Salud en el Trabajo. A través de esta plataforma, se busca mantener un control 
        riguroso y profesional de las incidencias y acciones correctivas en el SENA.
      </p>
      <p>
        Por favor, inicie sesión para acceder a todas las funcionalidades y gestionar la información de manera eficiente.
      </p>
      <a href="/login" class="btn">Iniciar Sesión</a>
    </div>
  </div>
</body>
</html>
