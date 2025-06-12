<?php
include '../header.php';
include '../config/conexion.php';

if (!isset($_GET['id'])) {
    echo "ID de usuario no especificado.";
    exit;
}

$id = $_GET['id'];
$sql = "SELECT nombre_usuario FROM Usuario WHERE idUsuario = $id";
$resutlado = mysqli_query($conn, $sql);
$datos_usuario = mysqli_fetch_assoc($resutlado); // Usamos variable diferente

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "UPDATE Usuario SET rol = 'bann' WHERE idUsuario = $id";
    $resultado = mysqli_query($conn, $sql);

    $sql = mysqli_query($conn, "DELETE FROM Opinion WHERE idUsuario = $id");
    $resutlado = mysqli_query($conn, $sql);
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Banear usuario</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    <div class="container mt-5">
        <?php if ($resultado): ?>
            <div class="alert alert-success">El usuario #<?= $id ?> ha sido baneado correctamente.</div>
        <?php else: ?>
            <div class="alert alert-danger">Error al banear: <?= mysqli_error($conn) ?></div>
        <?php endif; ?>
        <a href="../usuarios.php" class="btn btn-light">Volver</a>
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
    <title>Confirmar baneo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5 text-center hei">
    <h3 class="mb-4">
        ¿Seguro que quieres banear al usuario #<?= $id ?> |
        <?= htmlspecialchars($datos_usuario['nombre_usuario']) ?>?
    </h3>
    <form method="POST">
        <button type="submit" class="btn btn-danger me-2">Sí, banear</button>
        <a href="../usuarios.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>
