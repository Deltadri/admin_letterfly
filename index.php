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
include 'config/conexion.php';
include 'header.php';
// EL HTTP REMOTE USER PILLA EL USUAIRO QUE SE HA IDENTIFICADO CON AUTHELIA
$usuario = $_SERVER[HTTP_REMOTE_USER];
// Consultas para obtener totales
$totalUsuarios = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM Usuario"))['total'];
$totalLibros = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM Libro"))['total'];
$totalResenas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM Opinion"))['total'];
$libroPopular = mysqli_fetch_assoc(mysqli_query($conn,
  "SELECT Libro.titulo, COUNT(*) as total FROM Opinion
   JOIN Libro ON Opinion.idLibro = Libro.idLibro
   GROUP BY Opinion.idLibro ORDER BY total DESC LIMIT 1"
));
$totalbaneados = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM Usuario WHERE rol LIKE 'bann'"))['total'];
?>

<h2 class="mb-4">Hola <?php echo "$usuario";?></h2>

<div class="row">
  <div class="col-md-3 mb-3">
    <div class="card text-white bg-primary">
      <div class="card-body">
        <h5 class="card-title">Usuarios</h5>
        <p class="card-text fs-4"><?php echo $totalUsuarios; ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-3 mb-3">
    <div class="card text-white bg-success">
      <div class="card-body">
        <h5 class="card-title">Libros</h5>
        <p class="card-text fs-4"><?php echo $totalLibros; ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-3 mb-3">
    <div class="card text-white bg-warning">
      <div class="card-body">
        <h5 class="card-title">Reseñas</h5>
        <p class="card-text fs-4"><?php echo $totalResenas; ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-3 mb-3">
    <div class="card text-white bg-danger">
      <div class="card-body">
        <h5 class="card-title">Usuarios Baneados</h5>
        <p class="card-text fs-4"><?php echo $totalbaneados; ?></p>
      </div>
    </div>
</div>

<div class="row mt-4">

  <div class="col-md-6 mb-3">
    <div class="card border-dark">
      <div class="card-body">
        <h5 class="card-title">Libro con más reseñas</h5>
        <p class="card-text fs-5">
          <?php 
            if ($libroPopular) {
              echo htmlspecialchars($libroPopular['titulo']) . " (" . $libroPopular['total'] . " reseñas)";
            } else {
              echo "No hay reseñas disponibles.";
            }
          ?>
        </p>
      </div>
    </div>
  </div>

<?php
// Cierre del diseño
echo '</div></body></html>';
?>
