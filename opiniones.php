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

// Búsqueda por libro, usuario o contenido del comentario
$busqueda = isset($_GET['busqueda']) ? mysqli_real_escape_string($conn, $_GET['busqueda']) : '';

$query = "
    SELECT O.idOpinion, L.titulo AS libro, U.nombre_usuario AS usuario, 
           O.puntuacion, O.comentario, O.fecha
    FROM Opinion O
    JOIN Libro L ON O.idLibro = L.idLibro
    JOIN Usuario U ON O.idUsuario = U.idUsuario
";

if (!empty($busqueda)) {
    $query .= " WHERE L.titulo LIKE '%$busqueda%' 
             OR U.nombre_usuario LIKE '%$busqueda%'
             OR O.comentario LIKE '%$busqueda%'";
}

$query .= " ORDER BY O.fecha DESC";

$resultado = mysqli_query($conn, $query);
?>

<div class="container mt-4">
    <form method="GET" action="opiniones.php" class="mb-4">
        <div class="input-group">
            <input type="text" name="busqueda" class="form-control" placeholder="Buscar por libro, usuario o comentario" value="<?= htmlspecialchars($busqueda) ?>">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <h3 class="mb-3">Listado de reseñas</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Libro</th>
                    <th>Usuario</th>
                    <th>Puntuación</th>
                    <th>Comentario</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!$resultado) {
                    echo "<tr><td colspan='7'>Error al obtener reseñas: " . mysqli_error($conn) . "</td></tr>";
                } elseif (mysqli_num_rows($resultado) === 0) {
                    echo "<tr><td colspan='7'>No hay reseñas.</td></tr>";
                } else {
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $id = htmlspecialchars($fila['idOpinion']);
                        echo "<tr>";
                        echo "<td>$id</td>";
                        echo "<td>" . htmlspecialchars($fila['libro']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['usuario']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['puntuacion']) . "/5</td>";
                        echo "<td>" . htmlspecialchars($fila['comentario']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['fecha']) . "</td>";
                        echo "<td>
                            <a href='funciones_opiniones/eliminar_opinion.php?id=$id' class='btn btn-sm btn-danger'>Eliminar</a>
                        </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
