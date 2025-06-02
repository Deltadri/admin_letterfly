<?php
include '../config/conexion.php';

if (!isset($_GET['id'])) {
    echo "ID de usuario no especificado.";
    exit;
}

$id = $_GET['id'];

// Si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevoPassword = $_POST['nuevo_password'];
    $hash = password_hash($nuevoPassword, PASSWORD_DEFAULT);

    if (empty($nuevoPassword)) {
        echo "El campo de contraseña no puede estar vacío.";
    } else {
        $sql = "UPDATE Usuario SET password = '$hash' WHERE idUsuario = $id";
        if (mysqli_query($conn, $sql)) {
            echo "<div class='alert alert-success m-3'>Contraseña actualizada correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger m-3'>Error: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container mt-5">
    <h3>Restablecer contraseña al usuario #<?= $id ?></h3>
    <form method="POST">
        <div class="mb-3">
            <label for="nuevo_password" class="form-label">Escribe la nueva contraseña</label>
            <input type="text" class="form-control" id="nuevo_password" name="nuevo_password" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="../usuarios.php" class="btn btn-secondary">Volver</a>
    </form>
</div>
</body>
</html>
