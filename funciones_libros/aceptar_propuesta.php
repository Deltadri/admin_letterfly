<?php
include '../config/conexion.php';

if (!isset($_GET['id'])) {
    die("ID de propuesta no especificado.");
}

$idPropuesta = intval($_GET['id']);

// 1. Obtener los datos de la propuesta
$sql = "SELECT * FROM LibroPropuesto WHERE idPropuesta = $idPropuesta";
$res = mysqli_query($conn, $sql);
$propuesta = mysqli_fetch_assoc($res);

if (!$propuesta) {
    die("Propuesta no encontrada.");
}

$titulo = mysqli_real_escape_string($conn, $propuesta['titulo']);
$autorNombre = mysqli_real_escape_string($conn, $propuesta['autor_nombre']);
$descripcion = mysqli_real_escape_string($conn, $propuesta['descripcion']);
$paginas = intval($propuesta['paginas']);
$fpublicacion = $propuesta['fpublicacion'] ? "'" . mysqli_real_escape_string($conn, $propuesta['fpublicacion']) . "'" : "NULL";
$portada = mysqli_real_escape_string($conn, $propuesta['portada']);

// 2. Buscar si el autor ya existe
$autorCheck = mysqli_query($conn, "SELECT idAutor FROM Autor WHERE nombre = '$autorNombre'");
if (mysqli_num_rows($autorCheck) > 0) {
    $autor = mysqli_fetch_assoc($autorCheck);
    $idAutor = $autor['idAutor'];
} else {
    mysqli_query($conn, "INSERT INTO Autor (nombre) VALUES ('$autorNombre')");
    $idAutor = mysqli_insert_id($conn);
}

// 3. Insertar en la tabla Libro
$sqlLibro = "INSERT INTO Libro (titulo, autor, descripcion, paginas, fpublicacion, portada)
             VALUES ('$titulo', $idAutor, '$descripcion', $paginas, $fpublicacion, '$portada')";

$resultadoLibro = mysqli_query($conn, $sqlLibro);

// 4. Copiar imagen si se insertó el libro
if ($resultadoLibro) {
    $idLibroNuevo = mysqli_insert_id($conn);

    // Obtener los géneros (nombres separados por coma)
    $generosCadena = $propuesta['generos'];
    $generosNombres = array_map('trim', explode(',', $generosCadena));
    
    // Insertar relación libro-género
    foreach ($generosNombres as $nombreGenero) {
        if (empty($nombreGenero)) continue;
    
        $nombreEscapado = mysqli_real_escape_string($conn, $nombreGenero);
        $queryGenero = "SELECT idGenero FROM Genero WHERE nombre = '$nombreEscapado'";
        $resGenero = mysqli_query($conn, $queryGenero);
    
        if ($filaGenero = mysqli_fetch_assoc($resGenero)) {
            $idGenero = $filaGenero['idGenero'];
            mysqli_query($conn, "INSERT INTO LibroGenero (idLibro, idGenero) VALUES ($idLibroNuevo, $idGenero)");
        }
    }

    

    // Copiar la imagen de propuestas a portadas
    $rutaOrigen = '../portadas_propuestas/' . $portada;
    $rutaDestino = '../portadas/' . $portada;

    if (file_exists($rutaOrigen)) {
        copy($rutaOrigen, $rutaDestino);
    }

    // Marcar como aceptado
    mysqli_query($conn, "UPDATE LibroPropuesto SET estado = 'aceptado' WHERE idPropuesta = $idPropuesta");

    header("Location: ../libros_propuestos.php?success=1");
    exit;
} else {
    echo "Error al insertar libro: " . mysqli_error($conn);
}
?>
