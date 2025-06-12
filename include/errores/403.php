<?php
require ("../../header.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Letterfly</title>

  <style>
    body {
        background-color:rgb(32, 16, 181);
        color: white;
        text-align: center;
    }
  </style>
</head>
<body>
<?php
// Se incluye el archivo de estilos
    echo "<div class='container mt-5'>";
    
    $imagen = mt_rand(1, 2);
    if ($imagen == 1) {
        echo "<img src='/img/dibujitos/no.png' alt='Logo' width='200'>";
    } else {
        echo "<img src='/img/dibujitos/no2.png' alt='Logo' width='200'>";
    }

    echo "<h1>Che che che che!!!</h1>";
    echo "<h4>Tu aquí no puedes estar eh</h4>";
    echo "<br>";
    echo "<a href='/index.php' class='btn btn-lg hola'>Volver al Inicio</a>";
    echo "</div>";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>