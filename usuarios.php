<?php
include 'config/conexion.php';
include 'header.php';

// Recoger búsqueda
$busqueda = isset($_GET['busqueda']) ? mysqli_real_escape_string($conn, $_GET['busqueda']) : '';
?>

<div class="container mt-4">
    <form method="GET" action="usuarios.php" class="mb-4">
        <div class="input-group">
            <input type="text" name="busqueda" class="form-control" placeholder="Buscar por ID, nombre o email" value="<?= htmlspecialchars($busqueda) ?>">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <h3 class="mb-3">Listado de usuarios</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Consulta según búsqueda
                if (!empty($busqueda)) {
                    $query = "
                        SELECT idUsuario, nombre_usuario, email, fecha_registro, rol
                        FROM Usuario
                        WHERE idUsuario LIKE '%$busqueda%'
                           OR nombre_usuario LIKE '%$busqueda%'
                           OR email LIKE '%$busqueda%'
                    ";
                } else {
                    $query = "SELECT idUsuario, nombre_usuario, email, fecha_registro, rol FROM Usuario";
                }

                $resultado = mysqli_query($conn, $query);

                if (!$resultado) {
                    echo "<tr><td colspan='4'>Error al obtener usuarios: " . mysqli_error($conn) . "</td></tr>";
                } elseif (mysqli_num_rows($resultado) === 0) {
                    echo "<tr><td colspan='4'>No se encontraron usuarios.</td></tr>";
                } else {
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $id = htmlspecialchars($fila['idUsuario']);
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($fila['idUsuario']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['nombre_usuario']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['fecha_registro']) . "</td>";
                        echo "<td>
                        <a href='funciones_usuarios/restablecer_password.php?id=$id' class='btn btn-sm btn-warning me-1 mt-1 mb-1'>Reset Pass</a>
                        <a href='funciones_usuarios/banear_usuario.php?id=$id' class='btn btn-sm btn-danger me-1 mt-1 mb-1'>Banear</a>                        </td>";
                        if ($fila['rol'] == 'user') {
                            echo "<td><span class='badge bg-success'>Activo</span></td>";
                        } else {
                            echo "<td><span class='badge bg-danger'>Baneado</span></td>";
                        }
                        echo "</tr>";
                        
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
