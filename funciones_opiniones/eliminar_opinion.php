<?php
include '../config/conexion.php';
include '../header.php';


if (!isset($_GET['id'])) {
    echo "ID de Opinion no especificado.";
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT idOpinion FROM Opinion WHERE idOpinion = $id";
$res = mysqli_query($conn, $sql);
$libro = mysqli_fetch_assoc($res);

if (!$libro) {
    echo "Opinion no encontrada.";
    exit;
}

// Si se ha confirmado la eliminación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "DELETE FROM Opinion WHERE idOpinion = $id";
    $resultado = mysqli_query($conn, $sql);
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Eliminar Opinion</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <div class="container mt-5">
        <?php if ($resultado): ?>
            <div class="alert alert-success">El comentario #<?= $id ?> ha sido eliminado correctamente.</div>
        <?php else: ?>
            <div class="alert alert-danger">Error al eliminar el comentario: <?= mysqli_error($conn) ?></div>
        <?php endif; ?>
        <a href="../opiniones.php" class="btn btn-light">Volver</a>
    </div>
    </body>
    </html>
    <?php
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmar eliminación</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5 text-center hei">
    <h3 class="mb-4">
        ¿Seguro que quieres eliminar este comentario con ID:  #<?= $id ?> |
    </h3>
    <form method="POST">
        <button type="submit" class="btn btn-danger me-2">Sí, eliminar</button>
        <a href="../opiniones.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
