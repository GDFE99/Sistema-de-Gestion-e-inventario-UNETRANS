<?php
session_start();
require_once "./php/main.php";

try {
    // Obtener información del usuario antes de destruir la sesión
    $usuario_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;
    $usuario_usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;

    if ($usuario_id && $usuario_usuario) {
        // Conectar a la base de datos
        $conexion = conexion();

        // Registrar evento de cierre de sesión en la tabla de auditoría
        $evento = "Cierre de sesión";
        $detalle = "Usuario: " . $usuario_usuario . " cerró sesión.";
        $consultaAuditoria = $conexion->prepare("INSERT INTO auditoria (usuario_id, usuario_usuario, tabla_afectada, operacion, detalle, fecha) VALUES (:usuario_id, :usuario_usuario, 'usuarios', :operacion, :detalle, NOW())");
        $consultaAuditoria->bindParam(':usuario_id', $usuario_id);
        $consultaAuditoria->bindParam(':usuario_usuario', $usuario_usuario);
        $consultaAuditoria->bindParam(':operacion', $evento);
        $consultaAuditoria->bindParam(':detalle', $detalle);
        $consultaAuditoria->execute();

        // Cerrar la conexión a la base de datos
        $conexion = null;
    }

    // Destruir la sesión
    session_destroy();

    // Redirigir al usuario a la página de login
    if (headers_sent()) {
        echo "<script> window.location.href='index.php?vista=login'; </script>";
    } else {
        header("Location: index.php?vista=login");
    }
} catch (Exception $e) {
    // Manejo de errores
    echo '<div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            ' . $e->getMessage() . '
          </div>';
}
?>
