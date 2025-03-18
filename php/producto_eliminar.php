<?php
// Verificar si hay una sesión iniciada
if (isset($_SESSION['id'])) {
    $usuario_autenticado_id = $_SESSION['id']; // ID del usuario autenticado

    // Obtener el nombre del usuario autenticado desde la base de datos
    $conexion = conexion(); // Función para establecer la conexión a la base de datos
    $consulta_usuario_autenticado = $conexion->prepare("SELECT usuario_nombre FROM usuario WHERE usuario_id = :id");
    $consulta_usuario_autenticado->execute([':id' => $usuario_autenticado_id]);

    if ($consulta_usuario_autenticado->rowCount() == 1) {
        $datos_usuario_autenticado = $consulta_usuario_autenticado->fetch(PDO::FETCH_ASSOC);
        $usuario_autenticado_nombre = $datos_usuario_autenticado['usuario_nombre'];

        // Proceder con la eliminación del producto
        $product_id_del = limpiar_cadena($_GET['product_id_del']);

        // Verificar si hay préstamos activos asociados al producto
        $consulta_prestamos = $conexion->prepare("SELECT COUNT(*) AS total FROM prestamos WHERE producto_id = :producto_id");
        $consulta_prestamos->execute([':producto_id' => $product_id_del]);
        $total_prestamos = $consulta_prestamos->fetchColumn();

        if ($total_prestamos > 0) {
            echo '
                <div class="notification is-danger is-light">
                    <strong>No se puede eliminar el producto ya que hay préstamos activos asociados.</strong><br>
                    Por favor, asegúrate de que no haya préstamos activos antes de intentar eliminar el producto.
                </div>
            ';
        } else {
            // No hay préstamos activos, proceder con la eliminación del producto
            $consulta_producto = $conexion->prepare("SELECT producto_nombre, producto_foto FROM producto WHERE producto_id = :id");
            $consulta_producto->execute([':id' => $product_id_del]);

            if ($consulta_producto->rowCount() == 1) {
                $datos_producto = $consulta_producto->fetch();
                $producto_eliminar_nombre = $datos_producto['producto_nombre'];

                $eliminar_producto = $conexion->prepare("DELETE FROM producto WHERE producto_id = :id");
                $eliminar_producto->execute([':id' => $product_id_del]);

                if ($eliminar_producto->rowCount() == 1) {
                    // Registro en el log de auditoría con el usuario autenticado
                    $mensajeLog = "Se ha eliminado el producto $producto_eliminar_nombre con ID: $product_id_del por el usuario $usuario_autenticado_nombre";
                    escribirLog($mensajeLog, $usuario_autenticado_id);

                    $detalle = "Producto eliminado. Nombre: $producto_eliminar_nombre";
                     registrarAuditoria($conexion, $usuario_autenticado_id, $usuario_autenticado_nombre, 'producto', 'DELETE', $detalle);
                     
                    // Eliminar la foto del producto si existe
                    $foto_producto = $datos_producto['producto_foto'];
                    if (is_file("./img/producto/" . $foto_producto)) {
                        chmod("./img/producto/" . $foto_producto, 0777);
                        unlink("./img/producto/" . $foto_producto);
                    }

                    echo '
                        <div class="notification is-info is-light">
                            <strong>¡PRODUCTO ELIMINADO!</strong><br>
                            Los datos del producto "' . $producto_eliminar_nombre . '" se eliminaron con éxito.
                        </div>
                    ';
                } else {
                    echo '
                        <div class="notification is-danger is-light">
                            <strong>¡Ocurrió un error inesperado!</strong><br>
                            No se pudo eliminar el producto, por favor intente nuevamente.
                        </div>
                    ';
                }
            } else {
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrió un error inesperado!</strong><br>
                        El producto que intenta eliminar no existe.
                    </div>
                ';
            }
        }
    }
}

// Cerrar conexiones y liberar recursos
$conexion = null;
?>
