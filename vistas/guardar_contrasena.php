<?php
require_once "../php/main.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["usuario"])) {
    // Recibir y limpiar el nombre de usuario
    $usuario = limpiar_cadena($_POST["usuario"]);

    // Recibir la nueva contraseña y aplicar validaciones
    $nueva_contrasena = $_POST["nueva_contrasena"];

    // Validar que la contraseña contenga al menos un carácter especial y una letra mayúscula
    if (!preg_match('/[!@#$%^&*()_+\-=\[\]{};:\'"\\|,.<>\/?]+/', $nueva_contrasena) || !preg_match('/[A-Z]+/', $nueva_contrasena)) {
        echo "<script>alert('La contraseña debe contener al menos un carácter especial y una letra mayúscula.');</script>";
        echo "<script>window.location.href = 'procesar_respuestas.php?usuario=$usuario';</script>";
        exit;
    }

    // Hash de la nueva contraseña
    $clave = password_hash($nueva_contrasena, PASSWORD_BCRYPT, ["cost" => 10]);

    // Consulta para actualizar la contraseña en la base de datos con la contraseña hasheada
    $sql = "UPDATE usuario SET usuario_clave = '$clave' WHERE usuario_usuario = '$usuario'";

    if ($conn->query($sql) === TRUE) {
        // Redireccionar a la página de inicio con un mensaje de éxito
        header("Location: ../index.php?vista=login&success=true&message=Se%20restableció%20la%20contraseña%20con%20éxito");
        exit;
    } else {
        echo "Error al actualizar la contraseña: " . $conn->error;
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si se intenta acceder directamente a este archivo sin enviar datos, redirigir a otra página o mostrar un mensaje de error
    header("Location: otra_pagina.php");
    exit;
}
?>
