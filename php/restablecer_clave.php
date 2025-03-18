<?php
require_once "../inc/session_start.php";
require_once "main.php";

// Obtener ID de usuario, nueva clave y confirmación de clave del formulario
$id = limpiar_cadena($_POST['usuario_id']);
$nueva_clave = limpiar_cadena($_POST['nueva_clave']);
$confirmar_clave = limpiar_cadena($_POST['confirmar_clave']);

// Verificar si el usuario existe
$check_usuario = conexion()->prepare("SELECT * FROM usuario WHERE usuario_id = :id");
$check_usuario->bindParam(':id', $id);
$check_usuario->execute();

if ($check_usuario->rowCount() <= 0) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrió un error inesperado!</strong><br>
            El usuario no existe en el sistema
        </div>
    ';
    exit();
}

// Validar que las claves coincidan
if ($nueva_clave !== $confirmar_clave) {
    $error_message = 'Las claves no coinciden. Por favor, vuelve a intentar.';
} else if (strlen($nueva_clave) < 8) {
    $error_message = 'La clave debe tener al menos 8 caracteres.';
} else if (!preg_match('/[A-Z]/', $nueva_clave)) {
    $error_message = 'La clave debe contener al menos una letra mayúscula.';
} else if (!preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $nueva_clave)) {
    $error_message = 'La clave debe contener al menos un carácter especial (!@#$%^&*()-_=+{};:,<.>).';
} else {
    // Hash de la nueva clave
    $clave_hash = password_hash($nueva_clave, PASSWORD_BCRYPT);
    // Actualizar la clave del usuario
    $actualizar_clave = conexion()->prepare("UPDATE usuario SET usuario_clave = :clave WHERE usuario_id = :id");
    $actualizar_clave->bindParam(':clave', $clave_hash);
    $actualizar_clave->bindParam(':id', $id);
    if ($actualizar_clave->execute()) {
        $usuario_id_actualizado = limpiar_cadena($_POST['usuario_id']); // Obtener el ID del usuario actualizado

        header("Location: ../index.php?vista=user_count&user_id_up=$usuario_id_actualizado&success=true&message=Se%20restablecio%20la%20contraseña%20con%20éxito");
       
        exit(); // Importante: Detener la ejecución después de redirigir
    } else {
        $error_message = 'Error al actualizar la clave. Por favor, inténtalo de nuevo.';
    }
}

if (isset($error_message)) {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Error!</strong><br>
            ' . $error_message . '
        </div>
    ';
    exit();
}
?>
