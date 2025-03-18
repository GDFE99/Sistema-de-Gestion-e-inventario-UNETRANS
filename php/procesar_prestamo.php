<?php
require_once "main.php";
require_once "../inc/session_start.php";

// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    $profesor_id = $_POST['profesor_id'];
    $fecha_devolucion = $_POST['fecha_devolucion']; // Nuevo parámetro fecha_devolucion

    // Verificar si se han proporcionado valores válidos
    if (!empty($producto_id) && !empty($cantidad) && !empty($profesor_id) && !empty($fecha_devolucion)) {
        // Verificar si hay stock del producto seleccionado
        $stockDisponible = obtenerStockDisponible($producto_id);

        if ($stockDisponible < $cantidad) {
            // Redireccionar de vuelta a la página de préstamos con un mensaje de error
            header("Location: ../index.php?vista=nueva_prestamo&error=stock_insuficiente");
            exit();
        }

        try {
            // Establecer la conexión a la base de datos
            $conexion = conexion();

            // Insertar el nuevo préstamo en la tabla prestamos asociándolo al profesor seleccionado
            $insert_prestamo = "INSERT INTO prestamos (profesor_id, cantidad, fecha_solicitud, fecha_devolucion, producto_id)
            VALUES (:profesor_id, :cantidad, NOW(), :fecha_devolucion, :producto_id)"; // Añadido fecha_devolucion

            // Preparar la consulta
            $stmt = $conexion->prepare($insert_prestamo);

            // Bind de parámetros
            $stmt->bindParam(':profesor_id', $profesor_id);
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':fecha_devolucion', $fecha_devolucion); // Añadido fecha_devolucion
            $stmt->bindParam(':producto_id', $producto_id);

                // Ejecutar la consulta
            $stmt->execute();

            // Registrar la acción en el log
            

            // Actualizar el stock del producto
            $actualizar_stock = "UPDATE producto SET producto_stock = producto_stock - :cantidad WHERE producto_id = :producto_id";

            // Preparar la consulta
            $stmt = $conexion->prepare($actualizar_stock);

            // Bind de parámetros
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':producto_id', $producto_id);

            // Ejecutar la consulta
            $stmt->execute();

            // Actualizar el stock del producto
            $actualizar_stock = "UPDATE producto SET producto_stock = producto_stock - :cantidad WHERE producto_id = :producto_id";

            // Preparar la consulta
            $stmt = $conexion->prepare($actualizar_stock);

            // Bind de parámetros
            $stmt->bindParam(':cantidad', $cantidad);
            $stmt->bindParam(':producto_id', $producto_id);

            $mensaje = "Se ha realizado un nuevo préstamo (ID: $producto_id, Cantidad: $cantidad, Profesor ID: $profesor_id)";
            escribirLog($mensaje);

            // Ejecutar la consulta
            $stmt->execute();

            // Redireccionar a la página de éxito con un mensaje
            header("Location: ../index.php?vista=nueva_prestamo&success=true&message=El%20préstamo%20se%20realizó%20con%20éxito");
            $detalle = "Prestamo creado. por: $nombre, ";
            registrarAuditoria($conexion, $_SESSION['id'], $_SESSION['nombre'], 'categoria', 'INSERT', $detalle);
            exit(); // Salir después de redirigir
        } catch (PDOException $e) {
            // Manejo de errores
            echo "Error: " . $e->getMessage();
        }
    } else {
        // Mensaje de error si faltan datos
        echo "<script>
                window.onload = function() {
                    alert('Por favor, complete todos los campos.');
                    window.history.back();
                }
              </script>";
    }
}
?>




