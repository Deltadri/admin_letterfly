<?php
include '../config/conexion.php';

if (!isset($_GET['id'])) {
    die("ID de propuesta no especificado.");
}

$idPropuesta = intval($_GET['id']);

$sql = "UPDATE LibroPropuesto SET estado = 'rechazado' WHERE idPropuesta = $idPropuesta";

if (mysqli_query($conn, $sql)) {
    header("Location: ../libros_propuestos.php");
    exit;
} else {
    echo "Error al marcar como rechazado: " . mysqli_error($conn);
}
?>