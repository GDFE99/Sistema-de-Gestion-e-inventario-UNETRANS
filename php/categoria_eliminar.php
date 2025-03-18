<?php
require_once "./php/main.php";
// Función para obtener el nombre de la categoría por su ID
function obtenerNombreCategoria($categoria_id) {
    $conexion = conexion(); // Establece la conexión a la base de datos

    $consulta = $conexion->prepare("SELECT categoria_nombre FROM categoria WHERE categoria_id = :id");
    $consulta->execute([':id' => $categoria_id]);

    if ($consulta->rowCount() == 1) {
        $datos_categoria = $consulta->fetch(PDO::FETCH_ASSOC);
        return $datos_categoria['categoria_nombre'];
    }

    return false; // Devuelve false si no se encuentra la categoría
}

if (isset($_SESSION['id'])) {
    $usuario_autenticado_id = $_SESSION['id']; // ID del usuario autenticado

    // Obtener el nombre del usuario autenticado desde la base de datos
    $conexion = conexion(); // Suponiendo que tienes una función para establecer la conexión a la base de datos
    $consulta_usuario_autenticado = $conexion->prepare("SELECT usuario_nombre FROM usuario WHERE usuario_id = :id");
    $consulta_usuario_autenticado->execute([':id' => $usuario_autenticado_id]);

    if ($consulta_usuario_autenticado->rowCount() == 1) {
        $datos_usuario_autenticado = $consulta_usuario_autenticado->fetch(PDO::FETCH_ASSOC);
        $usuario_autenticado_nombre = $datos_usuario_autenticado['usuario_nombre'];

        // Obtener el ID de la categoría a eliminar
        $category_id_del = limpiar_cadena($_GET['category_id_del']);

        // Obtener el nombre de la categoría a eliminar
        $categoria_eliminar_nombre = obtenerNombreCategoria($category_id_del);

        if ($categoria_eliminar_nombre) {
            // Verificar si la categoría existe y si tiene productos asociados
            $check_categoria = conexion()->query("SELECT categoria_id FROM categoria WHERE categoria_id='$category_id_del'");
            
            if ($check_categoria->rowCount() == 1) {
                $check_productos = conexion()->query("SELECT categoria_id FROM producto WHERE categoria_id='$category_id_del' LIMIT 1");

                if ($check_productos->rowCount() <= 0) {
                    // Eliminar la categoría si no tiene productos asociados
                    $eliminar_categoria = conexion()->prepare("DELETE FROM categoria WHERE categoria_id=:id");
                    $eliminar_categoria->execute([":id" => $category_id_del]);

                    if ($eliminar_categoria->rowCount() == 1) {
                        // Escribir en el log
                        $detalle = "Categoria eliminada. Nombre:  $categoria_eliminar_nombre";
                        registrarAuditoria($conexion, $usuario_autenticado_id, $usuario_autenticado_nombre, 'categoria', 'DELETE', $detalle);

                        echo '
                            <div class="notification is-info is-light">
                                <strong>¡CATEGORÍA ELIMINADA!</strong><br>
                                Los datos de la categoría se eliminaron con éxito
                            </div>
                        ';
                    } else {
                        echo '
                            <div class="notification is-danger is-light">
                                <strong>¡Ocurrió un error inesperado!</strong><br>
                                No se pudo eliminar la categoría, por favor intente nuevamente
                            </div>
                        ';
                    }
                } else {
                    echo '
                        <div class="notification is-danger is-light">
                            <strong>¡Ocurrió un error inesperado!</strong><br>
                            No podemos eliminar la categoría ya que tiene productos asociados
                        </div>
                    ';
                }
                $check_productos = null;
            } else {
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrió un error inesperado!</strong><br>
                        La categoría que intenta eliminar no existe
                    </div>
                ';
            }
            $check_categoria = null;
        } else {
            echo '
                <div class="notification is-danger is-light">
                    <strong>¡Ocurrió un error inesperado!</strong><br>
                    No se encontró la categoría a eliminar
                </div>
            ';
        }
    }
}
?>
