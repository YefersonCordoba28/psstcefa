<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de Gestión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f4f4;
      font-family: Arial, sans-serif;
    }
    .header {
      background-color: #003366;
      color: white;
      padding: 20px;
      text-align: center;
    }
    .content {
      margin: 20px;
      background: white;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      padding: 20px;
    }
    .chat-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #007bff;
      color: white;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      cursor: pointer;
    }
    .chat-button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
<div class="container-fluid bg-primary text-white py-4 shadow-sm">
  <div class="row align-items-center">
    <div class="col-md-2 text-center">
      <!-- Logo o ícono opcional -->
      <img src="{{ asset('images/por.png') }}" alt="Logotipo SST" style="width: 45px; height: 60px; object-fit: contain;">
    </div>
    <div class="col-md-8 text-center">
    
      <h1 class="h3 fw-bold mb-0">Sistema de Gestión de Seguridad y Salud en el Trabajo</h1>
    </div>
    <div class="col-md-2 text-center">
      <!-- Espacio para botones o perfil -->
      <button class="btn btn-outline-light">Inicio</button>
    </div>
  </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


  <div class="content">
    

    <!-- Carrusel de imágenes -->
    <center><div id="carouselCertificaciones" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
         <img src="{{ asset('images/logo.png') }}" class="d-block w-40" alt="lal">
        </div>
        <div class="carousel-item">
        <center>  <img src="{{ asset('images/carrusel1.jpg') }}" class="d-block w-50" alt="Certificación 2">  
        </div>
        <div class="carousel-item">
          <img src="{{ asset('images/carrusel1.jpg') }}" class="d-block w-500" alt="Certificación 3">
        </div>
      </div>
</center>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselCertificaciones" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselCertificaciones" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
      </button>
    </div>

    <div class="d-flex gap-3 mt-4">
      <a href="login.html" class="btn btn-primary">Login</a>
      <a href="register.html" class="btn btn-secondary">Register</a>
    </div>
  </div>

  <div class="chat-button">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
      <path d="M2 2a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h3v2.5l3-2.5h6a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2zm11 7a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-3 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
    </svg>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
