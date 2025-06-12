<?php
include '../config/conexion.php';
include '../header.php';

if (!isset($_GET['id'])) {
    die("ID de libro no especificado.");
}

$idLibro = intval($_GET['id']);

// Obtener datos actuales del libro
$sql = "SELECT * FROM Libro WHERE idLibro = $idLibro";
$res = mysqli_query($conn, $sql);
$libro = mysqli_fetch_assoc($res);

if (!$libro) {
    die("Libro no encontrado.");
}

// Obtener todos los autores
$autores = mysqli_query($conn, "SELECT * FROM Autor ORDER BY nombre ASC");

// Obtener todos los géneros
$generos = mysqli_query($conn, "SELECT * FROM Genero ORDER BY nombre ASC");

// Obtener los géneros actuales del libro
$generosLibro = [];
$resGenerosLibro = mysqli_query($conn, "SELECT idGenero FROM LibroGenero WHERE idLibro = $idLibro");
while ($fila = mysqli_fetch_assoc($resGenerosLibro)) {
    $generosLibro[] = $fila['idGenero'];
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);
    $paginas = intval($_POST['paginas']);
    $fpublicacion = !empty($_POST['fpublicacion']) ? "'" . mysqli_real_escape_string($conn, $_POST['fpublicacion']) . "'" : "NULL";
    $idAutor = intval($_POST['autor']);
    $portadaActual = $libro['portada'];

    // Comprobar si hay nueva imagen
    if (isset($_FILES['portada']) && $_FILES['portada']['error'] === UPLOAD_ERR_OK) {
        $nombreOriginal = basename($_FILES['portada']['name']);
        $extension = pathinfo($nombreOriginal, PATHINFO_EXTENSION);
        $nuevaPortada = uniqid('portada_', true) . '.' . $extension;

        $rutaDestino = '../portadas/' . $nuevaPortada;
        move_uploaded_file($_FILES['portada']['tmp_name'], $rutaDestino);

        $portadaFinal = $nuevaPortada;
    } else {
        $portadaFinal = $portadaActual;
    }

    $sqlUpdate = "UPDATE Libro 
                  SET titulo = '$titulo',
                      descripcion = '$descripcion',
                      paginas = $paginas,
                      fpublicacion = $fpublicacion,
                      autor = $idAutor,
                      portada = '$portadaFinal'
                  WHERE idLibro = $idLibro";

    $resultado = mysqli_query($conn, $sqlUpdate);

    if ($resultado) {
        // Borrar géneros actuales
        mysqli_query($conn, "DELETE FROM LibroGenero WHERE idLibro = $idLibro");

        // Insertar nuevos géneros
        if (isset($_POST['generos']) && is_array($_POST['generos'])) {
            foreach ($_POST['generos'] as $idGenero) {
                $idGenero = intval($idGenero);
                mysqli_query($conn, "INSERT INTO LibroGenero (idLibro, idGenero) VALUES ($idLibro, $idGenero)");
            }
        }

        header("Location: ../libros.php?editado=1");
        exit;
    } else {
        $error = "Error al actualizar: " . mysqli_error($conn);
    }
}
?>

<div class="container mt-5">
    <h3 class="mb-4">Editar libro: <?= htmlspecialchars($libro['titulo']) ?></h3>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($libro['titulo']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Autor</label>
            <select name="autor" class="form-select" required>
                <?php while ($autor = mysqli_fetch_assoc($autores)): ?>
                    <option value="<?= $autor['idAutor'] ?>" <?= $autor['idAutor'] == $libro['autor'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($autor['nombre']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Géneros</label>
            <div class="row">
                <?php mysqli_data_seek($generos, 0); while ($genero = mysqli_fetch_assoc($generos)): ?>
                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="generos[]" value="<?= $genero['idGenero'] ?>"
                                <?= in_array($genero['idGenero'], $generosLibro) ? 'checked' : '' ?>>
                            <label class="form-check-label">
                                <?= htmlspecialchars($genero['nombre']) ?>
                            </label>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="4" required><?= htmlspecialchars($libro['descripcion']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Páginas</label>
            <input type="number" name="paginas" class="form-control" value="<?= $libro['paginas'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Fecha de publicación</label>
            <input type="date" name="fpublicacion" class="form-control" value="<?= $libro['fpublicacion'] ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Portada actual</label><br>
            <img src="../portadas/<?= htmlspecialchars($libro['portada']) ?>" width="100">
        </div>

        <div class="mb-3">
            <label class="form-label">Nueva portada (opcional)</label>
            <input type="file" name="portada" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Guardar cambios</button>
        <a href="../libros.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
