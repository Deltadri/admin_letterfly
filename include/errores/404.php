<?php
// Include the header menu
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
        echo "<img src='/img/dibujitos/confusion.png' alt='Logo' width='200'>";
    } else {
        echo "<img src='/img/dibujitos/confusion2.png' alt='Logo' width='200'>";
    }
    echo "<h1>Oh Vaya</h1>";
    echo "<h4>Parece que esta página no existe</h4>";
    $curiosidad = mt_rand(1, 20);
    echo "<br>";

    echo "<h5>Dato Curioso: </h5>";
    // Son hechos con IA (No me iba a poner a buscarlas xd
    // Cada vez que entras aqui te da una curiosidad random de esas 20)
    switch ($curiosidad) {
        case 1:
            echo "<p>¿Sabías que el libro más vendido de todos los tiempos es la Biblia?</p>";
            break;
        case 2:
            echo "<p>El primer libro impreso con tipos móviles fue la Biblia de Gutenberg en 1455.</p>";
            break;
        case 3:
            echo "<p>La novela más larga jamás escrita es 'En busca del tiempo perdido' de Marcel Proust.</p>";
            break;
        case 4:
            echo "<p>El término 'bibliomanía' se refiere a la obsesión por coleccionar libros.</p>";
            break;
        case 5:
            echo "<p>El libro más caro jamás vendido fue el 'Codex Leicester' de Leonardo da Vinci.</p>";
            break;
        case 6:
            echo "<p>La biblioteca más grande del mundo es la Biblioteca del Congreso en Washington, D.C.</p>";
            break;
        case 7:
            echo "<p>El libro más pequeño del mundo mide solo 0.07 mm x 0.10 mm.</p>";
            break;
        case 8:
            echo "<p>El género literario más antiguo conocido es la poesía épica.</p>";
            break;
        case 9:
            echo "<p>El Quijote de Miguel de Cervantes es considerado la primera novela moderna.</p>";
            break;
        case 10:
            echo "<p>El Día Mundial del Libro se celebra el 23 de abril.</p>";
            break;
        case 11:
            echo "<p>La palabra 'libro' proviene del latín 'liber', que significa 'parte interior de la corteza de un árbol'.</p>";
            break;
        case 12:
            echo "<p>El primer libro electrónico fue creado en 1971 por Michael S. Hart, fundador del Proyecto Gutenberg.</p>";
            break;
        case 13:
            echo "<p>La novela más traducida del mundo es 'El Principito' de Antoine de Saint-Exupéry.</p>";
            break;
        case 14:
            echo "<p>El escritor más prolífico de la historia es Ryoki Inoue, con más de 1,000 libros publicados.</p>";
            break;
        case 15:
            echo "<p>El término 'bestseller' se utilizó por primera vez en 1889 en un periódico estadounidense.</p>";
            break;
        case 16:
            echo "<p>La primera biblioteca pública gratuita se abrió en Manchester, Inglaterra, en 1852.</p>";
            break;
        case 17:
            echo "<p>El libro más robado de las bibliotecas es el Guinness World Records.</p>";
            break;
        case 18:
            echo "<p>El primer libro de bolsillo fue publicado por Penguin Books en 1935.</p>";
            break;
        case 19:
            echo "<p>La novela 'Moby Dick' de Herman Melville fue un fracaso comercial en su tiempo.</p>";
            break;
        case 20:
            echo "<p>El término 'autor' proviene del latín 'auctor', que significa 'creador' o 'fundador'.</p>";
            break;
    }

    echo "<a href='/index.php' class='btn btn-lg hola'>Volver al Inicio</a>";
    echo "</div>";
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>