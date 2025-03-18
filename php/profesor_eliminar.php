<?php
require_once "./php/main.php"; 



if (isset($_SESSION['id'])) {
    $usuario_autenticado_id = $_SESSION['id']; // ID del usuario autenticado

    // Obtener el nombre del usuario autenticado desde la base de datos
    $conexion = conexion(); // Suponiendo que tienes una función para establecer la conexión a la base de datos
    $consulta_usuario_autenticado = $conexion->prepare("SELECT usuario_nombre FROM usuario WHERE usuario_id = :id");
    $consulta_usuario_autenticado->execute([':id' => $usuario_autenticado_id]);

    if ($consulta_usuario_autenticado->rowCount() == 1) {
        $datos_usuario_autenticado = $consulta_usuario_autenticado->fetch(PDO::FETCH_ASSOC);
        $usuario_autenticado_nombre = $datos_usuario_autenticado['usuario_nombre'];

$profesor_id_del = limpiar_cadena($_GET['profesor_id_del']);
$profesor_eliminar_nombre = obtenerNombreProfesor($profesor_id_del);


$check_profesor = conexion();
$check_profesor = $check_profesor->query("SELECT profesor_id, profesor_nombre FROM profesores WHERE profesor_id='$profesor_id_del'");

if ($check_profesor->rowCount() == 1) {
    $profesor = $check_profesor->fetch(PDO::FETCH_ASSOC);
    $profesor_id = $profesor['profesor_id'];
    $profesor_nombre = $profesor['profesor_nombre'];

    $check_prestamos = conexion();
    $check_prestamos = $check_prestamos->query("SELECT profesor_id FROM prestamos  WHERE profesor_id='$profesor_id_del' LIMIT 1");

    if ($check_prestamos->rowCount() <= 0) {

        $eliminar_profesor = conexion();
        $eliminar_profesor = $eliminar_profesor->prepare("DELETE FROM profesores WHERE profesor_id=:id");
        $eliminar_profesor->execute([":id" => $profesor_id_del]);

        if ($eliminar_profesor->rowCount() == 1) { 
                        $detalle = "Profesor eliminado. Nombre: $profesor_eliminar_nombre";
                        registrarAuditoria($conexion, $usuario_autenticado_id, $usuario_autenticado_nombre, 'profesor', 'DELETE', $detalle);
            

            echo '
                <div class="notification is-info is-light">
                    <strong>¡ PROFESOR ELIMINADO!</strong><br>
                    Los datos del profesor se eliminaron con éxito
                </div>
            ';
        } else {
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    No se pudo eliminar el usuario, por favor inténtelo nuevamente
                </div>
            ';
        }
        $eliminar_profesor = null;
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No podemos eliminar el usuario ya que tiene productos registrados asociados
            </div>
        ';
    }
    $check_prestamos = null;
} else {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El profesor que intenta eliminar no existe
        </div>
    ';
}
}
}

$check_profesor = null;
    
