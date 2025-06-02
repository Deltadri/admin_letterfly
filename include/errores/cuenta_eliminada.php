<?php
// se que esto no es un error pero lo he metido aqui por no ponerlo to en el mismo sitio xd
session_start();
include '../../header.php';
include '../../config/conexion.php';
if (!isset($_SESSION['idUsuario'])) {
    header("Location: ../../login.php");
    exit;
}
$idUsuario = $_SESSION['idUsuario'];
$nombreUsuario = $_SESSION['user'];

?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            <div class="d-flex justify-content-center mb-3">
                <img src='../../img/dibujitos/eliminada.png' alt='Cuenta eliminada' width='200'>
            </div>
            <h3 class="mb-4 text-center">Cuenta eliminada</h3>
            <p class="text-center">Tu cuenta ha sido eliminada con éxito. Si deseas volver a registrarte, puedes hacerlo en cualquier momento.</p>
            <div class="d-flex justify-content-center">
                <a href="../../login.php" class="btn btn-primary">Volver a la página de inicio</a>
            </div>
        </div>
    </div>
</div>

<?php
session_destroy();
?>