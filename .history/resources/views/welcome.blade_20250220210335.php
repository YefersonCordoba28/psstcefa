<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de Gestión de Seguridad y Salud en el Trabajo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .header {
      background-color: #004080;
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 2rem;
      font-weight: bold;
    }
    .carousel-item img {
      max-height: 400px;
      object-fit: cover;
    }
    .floating-btn {
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
      transition: background-color 0.3s;
    }
    .floating-btn:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

  <div class="header">
    Sistema de Gestión de Seguridad y Salud en el Trabajo
  </div>

  <div id="carouselExampleIndicators" class="carousel slide container my-5" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="d-flex align-items-center">
          <div class="w-50 p-4">
            <h2 class="text-primary">El Ministerio de Ambiente y Desarrollo Sostenible certifica nuevamente sus Sistemas de Gestión en la vigencia 2022</h2>
            <ul>
              <li>Sistema de Gestión de Calidad - ISO 9001:2015</li>
              <li>Sistema de Gestión Ambiental - ISO 14001:2015</li>
            </ul>
            <div class="d-flex gap-3 mt-3">
              <img src="/logo.png" alt="" width="60">
              <img src="/porpng" alt="ISO 14001" width="60">
              <img src="/iqnet.png" alt="IQNet" width="80">
            </div>
          </div>
          <div class="w-50">
            <img src="/certificados_grupo.png" class="d-block w-100 rounded shadow" alt="Grupo Certificado">
          </div>
        </div>
      </div>
    </div>
  </div>

  <a href="#" class="floating-btn">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
      <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.826L15 11.2V5.383zM14.803 12 9.197 8.618l-.197.118-.197-.118L1.197 12A1 1 0 0 0 2 13h12a1 1 0 0 0 .803-.383zM1 5.383V11.2l4.708-3.191L1 5.383z"/>
    </svg>
  </a>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
