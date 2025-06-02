<?php
include 'config/conexion.php';
include 'header.php';

// Recoger búsqueda
$busqueda = isset($_GET['busqueda']) ? mysqli_real_escape_string($conn, $_GET['busqueda']) : '';

// Consulta base
$query = "
    SELECT L.idLibro, L.titulo, A.nombre AS autor,
           L.descripcion, L.paginas, L.portada, L.fpublicacion,
           GROUP_CONCAT(G.nombre SEPARATOR ', ') AS generos
    FROM Libro L
    LEFT JOIN Autor A ON L.autor = A.idAutor
    LEFT JOIN LibroGenero LG ON L.idLibro = LG.idLibro
    LEFT JOIN Genero G ON LG.idGenero = G.idGenero
";

// Si hay búsqueda, añadir WHERE
if (!empty($busqueda)) {
    $query .= "
        WHERE L.idLibro LIKE '%$busqueda%'
           OR L.titulo LIKE '%$busqueda%'
           OR A.nombre LIKE '%$busqueda%'
    ";
}

// Agrupar para que funcione el GROUP_CONCAT
$query .= " GROUP BY L.idLibro";

$resultado = mysqli_query($conn, $query);
?>

<div class="container mt-4">
    <form method="GET" action="libros.php" class="mb-4">
        <div class="input-group">
            <input type="text" name="busqueda" class="form-control" placeholder="Buscar por ID, título o autor" value="<?= htmlspecialchars($busqueda) ?>">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <h3 class="mb-3">Listado de libros</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Géneros</th>
                    <th>Páginas</th>
                    <th>Publicación</th>
                    <th>Portada</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!$resultado) {
                    echo "<tr><td colspan='8'>Error al obtener libros: " . mysqli_error($conn) . "</td></tr>";
                } elseif (mysqli_num_rows($resultado) === 0) {
                    echo "<tr><td colspan='8'>No se encontraron libros.</td></tr>";
                } else {
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        $id = htmlspecialchars($fila['idLibro']);
                        echo "<tr>";
                        echo "<td>" . $id . "</td>";
                        echo "<td>" . htmlspecialchars($fila['titulo']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['autor']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['generos']) . "</td>";
                        echo "<td>" . htmlspecialchars($fila['paginas']) . "</td>";
                        echo "<td>" . ($fila['fpublicacion'] ?? 'Sin fecha') . "</td>";

                        //Literalmente hay que hacer un enlace simbolico a la carpeta del otro virtualhost
                        echo "<td><img src='portadas/" . htmlspecialchars($fila['portada']) . "' width='60'></td>";
                        echo "<td>
                            <a href='funciones_libros/editar_libro.php?id=$id' class='btn btn-sm btn-warning me-1 mt-1 mb-1'>Editar</a>
                            <a href='funciones_libros/eliminar_libro.php?id=$id' class='btn btn-sm btn-danger me-1 mt-1 mb-1'>Eliminar</a>
                            <a href='https://letterfly.net/libro.php?id=$id' class='btn btn-sm btn-success me-1 mt-1 mb-1'>Ver</a>
                        </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>
