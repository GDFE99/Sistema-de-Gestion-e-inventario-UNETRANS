<?php 
require_once "../inc/session_start.php"; 
require_once "main.php"; 

if (isset($_POST['usuario_id'])) {
    $usuario_id = limpiar_cadena($_POST['usuario_id']);
} else {
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Error!</strong><br>
            No se ha proporcionado el ID del usuario.
        </div>
    ';
    exit();
}

// Verificar si se reciben datos del formulario por POST
    $pregunta1 = limpiar_cadena($_POST['pregunta1']); // Asegúrate de obtener pregunta_1 desde $_POST
    $pregunta2 = limpiar_cadena($_POST['pregunta2']);
    $respuesta1 = limpiar_cadena($_POST['respuesta1']);
    $respuesta2 = limpiar_cadena($_POST['respuesta2']); 

    // Verificar que se proporcionaron todos los datos necesarios
    if (!$usuario_id || !$pregunta1 || !$respuesta1 || !$pregunta2 || !$respuesta2) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Error!</strong><br>
                Faltan datos requeridos para restablecer las preguntas de seguridad.
            </div>
        ';
        exit(); // Detener la ejecución del script
    }

    // Verificar que las preguntas sean diferentes
    if ($pregunta1 === $pregunta2) {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Error!</strong><br>
                Las preguntas de seguridad no pueden ser iguales. Por favor, elija preguntas distintas.
            </div>
        ';
        exit(); // Detener la ejecución del script
    }

    // Verificar que las respuestas no estén vacías
    if (empty($respuesta1) || empty($respuesta2)) { 
        echo ' 
            <div class="notification is-danger is-light"> 
                <strong>¡Error!</strong><br> 
                Las respuestas a las preguntas de seguridad no pueden estar vacías. 
            </div> 
        '; 
        exit(); // Detener la ejecución del script 
    } 

    // Actualizar las preguntas de seguridad del usuario en la base de datos
    $actualizar_preguntas = conexion()->prepare("UPDATE usuario SET pregunta1 = :pregunta1, respuesta1 = :respuesta1, pregunta2 = :pregunta2, respuesta2 = :respuesta2 WHERE usuario_id = :id");
    $actualizar_preguntas->bindParam(':pregunta1', $pregunta1);
    $actualizar_preguntas->bindParam(':respuesta1', $respuesta1);
    $actualizar_preguntas->bindParam(':pregunta2', $pregunta2);
    $actualizar_preguntas->bindParam(':respuesta2', $respuesta2);
    $actualizar_preguntas->bindParam(':id', $usuario_id);

    if ($actualizar_preguntas->execute()) {
        $usuario_id_actualizado = limpiar_cadena($_POST['usuario_id']); // Obtener el ID del usuario actualizado

         header("Location: ../index.php?vista=user_count&user_id_up=$usuario_id_actualizado&success=true&message=Se%20restablecieron%20las%20preguntas%20con%20éxito");
        echo '
            <div class="notification is-success is-light">
                Las preguntas de seguridad se han actualizado correctamente.
            </div>
        ';
    } else {
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Error!</strong><br>
                Ocurrió un error al actualizar las preguntas de seguridad.
            </div>
        ';
    }

?>
