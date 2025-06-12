<?php
include 'config/conexion.php';
include 'header.php';

$busqueda = isset($_GET['busqueda']) ? mysqli_real_escape_string($conn, $_GET['busqueda']) : '';

$query = "SELECT * FROM LibroPropuesto WHERE estado = 'pendiente'";


if (!empty($busqueda)) {
    $query .= "
        WHERE titulo LIKE '%$busqueda%'
           OR autor_nombre LIKE '%$busqueda%'
    ";
}

$resultado = mysqli_query($conn, $query);
?>

<div class="container mt-4">
    <form method="GET" action="libros_propuestos.php" class="mb-4">
        <div class="input-group">
            <input type="text" name="busqueda" class="form-control" placeholder="Buscar por título o autor" value="<?= htmlspecialchars($busqueda) ?>">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <h3 class="mb-3">Libros propuestos por usuarios</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Páginas</th>
                    <th>Publicación</th>
                    <th>Portada</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!$resultado) {
                    echo "<tr><td colspan='8'>Error: " . mysqli_error($conn) . "</td></tr>";
                } elseif (mysqli_num_rows($resultado) === 0) {
                    echo "<tr><td colspan='8'>No hay propuestas.</td></tr>";
                } else {
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $id = htmlspecialchars($fila['idPropuesta']);
                        echo "<tr>";
                        echo "<td>$id</td>";
                        echo "<td>" . htmlspecialchars($fila['titulo']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['autor_nombre']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['paginas']) . "</td>";
                        echo "<td>" . ($fila['fpublicacion'] ?? 'Sin fecha') . "</td>";

                        if ($fila['portada']) {
                            echo "<td><img src='https://letterfly.net/img/propuestas/" . htmlspecialchars($fila['portada']) . "' width='60'></td>";
                        } else {
                            echo "<td><span class='text-muted'>Sin imagen</span></td>";
                        }

                        echo "<td><span class='badge bg-" . ($fila['estado'] === 'pendiente' ? 'warning' : ($fila['estado'] === 'aceptado' ? 'success' : 'danger')) . "'>" . $fila['estado'] . "</span></td>";

                        echo "<td>
                            <a href='funciones_libros/aceptar_propuesta.php?id=$id' class='btn btn-sm btn-success me-1'>Aceptar</a>
                            <a href='funciones_libros/rechazar_propuesta.php?id=$id' class='btn btn-sm btn-danger'>Rechazar</a>
                        </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

