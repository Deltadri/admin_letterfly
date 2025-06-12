<!--
_______________________________________________________________________________
 __       ______  ______  ______  ______   ______   ______  __       __  __    
/\ \     /\  ___\/\__  _\/\__  _\/\  ___\ /\  == \ /\  ___\/\ \     /\ \_\ \   
\ \ \____\ \  __\\/_/\ \/\/_/\ \/\ \  __\ \ \  __< \ \  __\\ \ \____\ \____ \  
 \ \_____\\ \_____\ \ \_\   \ \_\ \ \_____\\ \_\ \_\\ \_\   \ \_____\\/\_____\ 
  \/_____/ \/_____/  \/_/    \/_/  \/_____/ \/_/ /_/ \/_/    \/_____/ \/_____/ 
_______________________________________________________________________________
Desarrollado por Adrián Fernández Ternero
Licenciado bajo: AGPLv3
letterfly.net


https://github.com/Adrifer24/admin_letterfly

-->

<?php
// No se necesita session_start() aquí porque Authelia ya gestiona el acceso
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Letterfly Admin</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/css/estilos.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand" href="/index.php">
      <img src="/img/logo/logo.png" alt="Logo Letterfly" width="130">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menuAdmin">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="menuAdmin">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link text-dark" href="/index.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="/usuarios.php">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="/libros.php">Libros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="/libros_propuestos.php">Propuestas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="/opiniones.php">Reseñas</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
