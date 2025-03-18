<?php
require_once "main.php";



$inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;
$tabla = "";

$consulta_datos = "SELECT prestamos.prestamo_id, prestamos.profesor_id, prestamos.cantidad, prestamos.fecha_solicitud,prestamos.fecha_devolucion,
                        profesores.profesor_nombre AS nombre_profesor, profesores.profesor_apellido AS apellido_profesor,
                        producto.producto_nombre, producto.producto_codigo, producto.producto_foto,
                        categoria.categoria_nombre
                    FROM prestamos
                    INNER JOIN profesores ON prestamos.profesor_id = profesores.profesor_id
                    INNER JOIN producto ON prestamos.producto_id = producto.producto_id
                    INNER JOIN categoria ON producto.categoria_id = categoria.categoria_id
                    ORDER BY prestamos.fecha_solicitud DESC LIMIT $inicio, $registros";

$consulta_total = "SELECT COUNT(prestamo_id) FROM prestamos";

$conexion = conexion(); // Conexión establecida aquí

$datos = $conexion->query($consulta_datos);
$datos = $datos->fetchAll();

$total = $conexion->query($consulta_total);
$total = (int) $total->fetchColumn();

$Npaginas = ceil($total / $registros);

$tabla .= '
    <div class="table-container">
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr class="has-text-centered">
                    <th>#</th>
                    <th>Producto</th>
                    <th>Código</th>
                    <th>Categoría</th>
                    <th>Profesor</th>
                    <th>Cantidad</th>
                    <th>Fecha de Solicitud</th>
                    <th>Fecha de Devolucion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
';

function prestamo_devolver($prestamo_id, $cantidad_devuelta) {
    $conexion = conexion();
    
    try {
        // Consulta para obtener información del préstamo
        $consulta_prestamo = "SELECT producto.producto_nombre, producto.producto_id, cantidad, 
        profesores.profesor_nombre, profesores.profesor_apellido,  prestamos.fecha_devolucion
        FROM prestamos 
        INNER JOIN producto ON prestamos.producto_id = producto.producto_id
        INNER JOIN profesores ON prestamos.profesor_id = profesores.profesor_id
        WHERE prestamo_id = :prestamo_id";
        $stmt = $conexion->prepare($consulta_prestamo);
        $stmt->bindParam(':prestamo_id', $prestamo_id);
        $stmt->execute();
        $prestamo = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Si se encuentra el préstamo
        if ($prestamo) {
            $producto_id = $prestamo['producto_id'];
            $cantidad_prestada = $prestamo['cantidad'];
            $producto_nombre = $prestamo['producto_nombre'];
            $profesor_nombre = $prestamo['profesor_nombre'] . ' ' . $prestamo['profesor_apellido'];
            $fecha_devolucion = $prestamo['fecha_devolucion'];


           
            
            // Verificar que la cantidad devuelta no sea mayor que la cantidad prestada originalmente
            if ($cantidad_devuelta > $cantidad_prestada) {
                return "No existe esa cantidad de productos en este préstamo"; // Mensaje de error
            }
            
            // Actualizar el stock del producto
            $consulta_actualizar_stock = "UPDATE producto SET producto_stock = producto_stock + :cantidad_devuelta WHERE producto_id = :producto_id";
            $stmt = $conexion->prepare($consulta_actualizar_stock);
            $stmt->bindParam(':cantidad_devuelta', $cantidad_devuelta);
            $stmt->bindParam(':producto_id', $producto_id);
            $stmt->execute();
            
            // Calcular la cantidad restante después de devolver la cantidad especificada
            $cantidad_restante = $cantidad_prestada - $cantidad_devuelta;

            $hoy = date("Y-m-d");
            $es_fecha_anterior = ($fecha_devolucion < $hoy);

            
            if ($cantidad_restante == 0) {
                // Si la cantidad restante es 0, eliminar el préstamo
                $consulta_eliminar_prestamo = "DELETE FROM prestamos WHERE prestamo_id = :prestamo_id";
                $stmt = $conexion->prepare($consulta_eliminar_prestamo);
                $stmt->bindParam(':prestamo_id', $prestamo_id);
                $stmt->execute();
            } else {
                // Actualizar la cantidad prestada en la tabla de préstamos
                $consulta_actualizar_cantidad = "UPDATE prestamos SET cantidad = :cantidad_restante WHERE prestamo_id = :prestamo_id";
                $stmt = $conexion->prepare($consulta_actualizar_cantidad);
                $stmt->bindParam(':cantidad_restante', $cantidad_restante);
                $stmt->bindParam(':prestamo_id', $prestamo_id);
                $stmt->execute();
            }

            $mensajeLog = "Se ha devuelto el préstamo del producto '$producto_nombre' (ID: $prestamo_id) por $profesor_nombre. Cantidad devuelta: $cantidad_devuelta";

                if ($es_fecha_anterior) {
                    $mensajeLog .= " (Devolución con fecha anterior al día actual)";
                }

                escribirLog($mensajeLog);
            
            $conexion = null;
            return true; // Éxito
        } else {
            return "No se encontró el préstamo"; // Mensaje de error
        }
    } catch (PDOException $e) {
        // Manejo de excepciones
        // Aquí puedes registrar el error en un archivo de registro o mostrar un mensaje al usuario
        return "Error en la base de datos"; // Mensaje de error
    }
}


if ($total >= 1 && $pagina <= $Npaginas) {
    $contador = $inicio + 1;
    $pag_inicio = $inicio + 1;
    foreach ($datos as $rows) {
        // Verificar si la fecha de devolución es anterior al día actual
        $fecha_devolucion = $rows['fecha_devolucion'];
        $hoy = date("Y-m-d"); // Obtener la fecha actual
        
        // Comprueba si la fecha de devolución es anterior al día actual
        $clase_fecha = ($fecha_devolucion < $hoy) ? 'fecha-anterior' : '';
        $mensaje_tooltip = ($fecha_devolucion < $hoy) ? 'La fecha de devolución ha pasado' : '';
    
        $tabla .= '
        <tr class="has-text-centered">
            <td>' . $contador . '</td>
            <td>' . $rows['producto_nombre'] . '</td>
            <td>' . $rows['producto_codigo'] . '</td>
            <td>' . $rows['categoria_nombre'] . '</td>
            <td>' . $rows['nombre_profesor'] . ' ' . $rows['apellido_profesor'] . '</td>
            <td>' . $rows['cantidad'] . '</td>
            <td class="' . $clase_fecha . ' fecha-anterior-tooltip" title="' . $mensaje_tooltip . '">' . $rows['fecha_solicitud'] . '</td>
            <td class="' . $clase_fecha . ' fecha-anterior-tooltip" title="' . $mensaje_tooltip . '">' . $rows['fecha_devolucion'] . '</td>  
            <td>
                <form action="" method="POST" id="devolverForm">
                    <input type="hidden" name="prestamo_id" value="' . $rows['prestamo_id'] . '">
                    <input type="number" name="cantidad_devuelta" placeholder="Cantidad devuelta" required>
                    <button type="submit" name="devolver" id="devolverBtn" class="button is-warning is-rounded is-small">Devolver</button>
                </form>
            </td>
        </tr>
        ';
        $contador++;
    }
    
    $pag_final = $contador - 1;
} else {
    if ($total >= 1) {
        $tabla .= '
            <tr class="has-text-centered" >
                <td colspan="8">
                    <a href="' . $url . '1" class="button is-link is-rounded is-small mt-4 mb-4">
                        Haga clic acá para recargar el listado
                    </a>
                </td>
            </tr>
        ';
    } else {
        $tabla .= '
            <tr class="has-text-centered" >
                <td colspan="8">
                    No hay registros en el sistema
                </td>
            </tr>
        ';
    }
}

$tabla .= '</tbody></table></div>';

if ($total > 0 && $pagina <= $Npaginas) {
    $tabla .= '<p class="has-text-right">Mostrando productos <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un <strong>total de ' . $total . '</strong></p>';
}

$conexion = null; // Conexión cerrada aquí
echo $tabla;

// Dentro del bloque PHP donde se maneja la devolución del préstamo
if (isset($_POST['devolver'])) {
    $prestamo_id = $_POST['prestamo_id'];
    $cantidad_devuelta = $_POST['cantidad_devuelta'];
    $fecha_devolucion = $_POST['fecha_devolucion']; // Obtener la fecha de devolución
    
    // Llamar a la función prestamo_devolver y pasar también la fecha de devolución
    $resultado = prestamo_devolver($prestamo_id, $cantidad_devuelta);
    
    if ($resultado === true) {
        echo '<script>
                alert("Devolución exitosa");
                window.location.href = window.location.href;
              </script>';
        exit(); // Salir del script PHP para evitar que se imprima el resto del contenido de la página
    } else {
        echo '<script>
                alert("' . $resultado . '");
              </script>';
    }
}



// Función para devolver un préstamo con la fecha de devolución
    $conexion = conexion();
    
    try {
        // Consulta para obtener información del préstamo
        $consulta_prestamo = "SELECT producto_id, cantidad FROM prestamos WHERE prestamo_id = :prestamo_id";
        $stmt = $conexion->prepare($consulta_prestamo);
        $stmt->bindParam(':prestamo_id', $prestamo_id);
        $stmt->execute();
        $prestamo = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Si se encuentra el préstamo
        if ($prestamo) {
            $producto_id = $prestamo['producto_id'];
            $cantidad_prestada = $prestamo['cantidad'];
            
            // Verificar que la cantidad devuelta no sea mayor que la cantidad prestada originalmente
            if ($cantidad_devuelta > $cantidad_prestada) {
                return "No existe esa cantidad de productos en este préstamo"; // Mensaje de error
            }
            
            // Actualizar el stock del producto
            $consulta_actualizar_stock = "UPDATE producto SET producto_stock = producto_stock + :cantidad_devuelta WHERE producto_id = :producto_id";
            $stmt = $conexion->prepare($consulta_actualizar_stock);
            $stmt->bindParam(':cantidad_devuelta', $cantidad_devuelta);
            $stmt->bindParam(':producto_id', $producto_id);
            $stmt->execute();
            
            // Calcular la cantidad restante después de devolver la cantidad especificada
            $cantidad_restante = $cantidad_prestada - $cantidad_devuelta;
            
            if ($cantidad_restante == 0) {
                // Si la cantidad restante es 0, eliminar el préstamo
                $consulta_eliminar_prestamo = "DELETE FROM prestamos WHERE prestamo_id = :prestamo_id";
                $stmt = $conexion->prepare($consulta_eliminar_prestamo);
                $stmt->bindParam(':prestamo_id', $prestamo_id);
                $stmt->execute();
            } else {
                // Actualizar la cantidad prestada en la tabla de préstamos
                $consulta_actualizar_cantidad = "UPDATE prestamos SET cantidad = :cantidad_restante, fecha_devolucion = :fecha_devolucion WHERE prestamo_id = :prestamo_id";
                $stmt = $conexion->prepare($consulta_actualizar_cantidad);
                $stmt->bindParam(':cantidad_restante', $cantidad_restante);
                $stmt->bindParam(':fecha_devolucion', $fecha_devolucion); // Agregar la fecha de devolución
                $stmt->bindParam(':prestamo_id', $prestamo_id);
                $stmt->execute();
            }
            
            $conexion = null;
            return true; // Éxito
        } else {
            return "No se encontró el préstamo"; // Mensaje de error
        }
    } catch (PDOException $e) {
        // Manejo de excepciones
        // Aquí puedes registrar el error en un archivo de registro o mostrar un mensaje al usuario
        return "Error en la base de datos"; // Mensaje de error
    }

  


