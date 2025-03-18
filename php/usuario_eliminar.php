<?php
require_once "./php/main.php"; // Incluir el archivo de log



// Verificar si hay una sesión activa y el usuario está autenticado
if (isset($_SESSION['id'])) {
    $usuario_autenticado_id = $_SESSION['id']; // ID del usuario autenticado

    // Obtener el nombre del usuario autenticado desde la base de datos
    $conexion = conexion(); // Suponiendo que tienes una función para establecer la conexión a la base de datos
    $consulta_usuario_autenticado = $conexion->prepare("SELECT usuario_nombre FROM usuario WHERE usuario_id = :id");
    $consulta_usuario_autenticado->execute([':id' => $usuario_autenticado_id]);

    if ($consulta_usuario_autenticado->rowCount() == 1) {
        $datos_usuario_autenticado = $consulta_usuario_autenticado->fetch(PDO::FETCH_ASSOC);
        $usuario_autenticado_nombre = $datos_usuario_autenticado['usuario_nombre'];

        // Verificar si el usuario a eliminar existe
        $user_id_del = limpiar_cadena($_GET['user_id_del']); // Asegúrate de sanitizar el ID recibido por GET

        $consulta_usuario_a_eliminar = $conexion->prepare("SELECT usuario_id, usuario_nombre FROM usuario WHERE usuario_id = :id");
        $consulta_usuario_a_eliminar->execute([':id' => $user_id_del]);

        if ($consulta_usuario_a_eliminar->rowCount() == 1) {
            $datos_usuario_a_eliminar = $consulta_usuario_a_eliminar->fetch(PDO::FETCH_ASSOC);
            $usuario_eliminar_nombre = $datos_usuario_a_eliminar['usuario_nombre'];

            // Verificar si el usuario tiene productos asociados
            $consulta_productos_asociados = $conexion->prepare("SELECT usuario_id FROM producto WHERE usuario_id = :id LIMIT 1");
            $consulta_productos_asociados->execute([':id' => $user_id_del]);

            if ($consulta_productos_asociados->rowCount() <= 0) {
                // Eliminar el usuario
                $eliminar_usuario = $conexion->prepare("DELETE FROM usuario WHERE usuario_id = :id");
                $eliminar_usuario->execute([':id' => $user_id_del]);

                if ($eliminar_usuario->rowCount() == 1) {
                    // Registro de evento en el log con los nombres de los usuarios
                    $detalle = "Usuario eliminado. Nombre: $usuario_eliminar_nombre";
                    registrarAuditoria($conexion, $usuario_autenticado_id, $usuario_autenticado_nombre, 'usuarios', 'DELETE', $detalle);

                    echo '
                        <div class="notification is-info is-light">
                            <strong>¡USUARIO ELIMINADO!</strong><br>
                            Los datos del usuario se eliminaron con éxito
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
            } else {
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrió un error inesperado!</strong><br>
                        No podemos eliminar el usuario ya que tiene productos registrados asociados
                    </div>
                ';
            }
        } else {
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    El USUARIO que intenta eliminar no existe
                </div>
            ';
        }
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrió un error inesperado!</strong><br>
                No se pudo obtener información del usuario autenticado
            </div>
        ';
    }

    // Cierra la conexión a la base de datos
    $conexion = null;
} else {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Error de autenticación!</strong><br>
            Por favor inicia sesión para realizar esta acción
        </div>
    ';
}

$check_usuario = null;

?>
