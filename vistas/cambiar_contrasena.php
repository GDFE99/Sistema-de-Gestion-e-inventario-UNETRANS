<?php
require_once "../php/main.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$mostrar_alerta = false; // Variable de control para mostrar la alerta
$pregunta1_bd = "";
$pregunta2_bd = "";
$error_usuario = false; // Variable para controlar si hay un error con el usuario
$mostrar_modal = false; // Variable para mostrar el modal de respuestas incorrectas

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    if (isset($_POST["usuario"])) {
        // Recibir y limpiar el nombre de usuario
        $usuario = limpiar_cadena($_POST["usuario"]);
        // Verificar si respuesta1 y respuesta2 están presentes en $_POST
        $respuesta1 = isset($_POST["respuesta1"]) ? limpiar_cadena($_POST["respuesta1"]) : "";
        $respuesta2 = isset($_POST["respuesta2"]) ? limpiar_cadena($_POST["respuesta2"]) : "";
        // Consultar la base de datos para obtener las preguntas y respuestas asociadas al usuario
        $sql = "SELECT pregunta1, pregunta2, respuesta1, respuesta2 FROM usuario WHERE usuario_usuario = '$usuario'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $respuesta1_bd = $row["respuesta1"];
            $respuesta2_bd = $row["respuesta2"];
            $pregunta1_bd = $row["pregunta1"];
            $pregunta2_bd = $row["pregunta2"];
            // Verificar si las respuestas coinciden con las preguntas asociadas al usuario
            if ($respuesta1 === $respuesta1_bd && $respuesta2 === $respuesta2_bd) {
                // Las respuestas coinciden, redirigir a la página para cambiar la contraseña
                echo "<script>window.location.href = 'procesar_respuestas.php?usuario=$usuario';</script>";
                exit;
            } else {
                // Las respuestas no coinciden, marcar para mostrar la alerta
                $mostrar_modal = true;
            }
        } else {
            // No se encontró el usuario en la base de datos
            $error_usuario = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Preguntas de Seguridad</title>
    <link rel="stylesheet" href="./css/bulma.min.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url("./img/IUT2.jpg") no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px; /* Reducir el espacio interno */
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 0.5s ease-in-out;
            max-width: 300px; /* Reducir el ancho máximo del contenedor */
            width: 100%; /* Hacer que el contenedor sea responsivo */
        }

        .title {
            margin-bottom: 15px; /* Reducir el espacio debajo del título */
        }

        .field:not(:last-child) {
            margin-bottom: 10px; /* Reducir el espacio entre campos */
        }

        .button {
            width: 100%; /* Ocupar todo el ancho disponible */
        }

        /* Ajustes para que el fondo se vea correctamente */
        html, body {
            height: 100%;
        }

        body {
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        /* Animación */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-container {
            background-color: rgba(255, 0, 0, 0.2);
            border: 1px solid #ff0000;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }

        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            animation-name: modalopen;
            animation-duration: 0.4s;
        }

        @keyframes modalopen {
            from {opacity: 0}
            to {opacity: 1}
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if($error_usuario): ?>
        <div class="error-container">
            <h5 class="title is-5 has-text-centered is-uppercase">Usuario no encontrado</h5>
            <p class="has-text-centered">Por favor, asegúrate de ingresar un usuario válido.</p>
        </div>
        <?php else: ?>
        <h5 class="title is-5 has-text-centered is-uppercase">Verificación de preguntas de seguridad</h5>
        <form action="" method="POST">
            <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>">
            <div class="field">
                <label class="label"><?php echo $pregunta1_bd; ?>:</label>
                <div class="control">
                    <input class="input" type="text" name="respuesta1" maxlength="255" required>
                </div>
            </div>
            <div class="field">
                <label class="label"><?php echo $pregunta2_bd; ?>:</label>
                <div class="control">
                    <input class="input" type="text" name="respuesta2" maxlength="255" required>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-info is-rounded">Verificar respuestas</button>
                </div>
            </div>
        </form>
        <?php endif; ?>
    </div>

    <!-- Modal de respuestas incorrectas -->
    <div id="myModal" class="modal" <?php echo $mostrar_modal ? 'style="display: block;"' : ''; ?>>
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p class="has-text-centered">Las respuestas ingresadas no son correctas. Por favor, inténtalo de nuevo.</p>
        </div>
    </div>

    <script>
        // Función para cerrar el modal
        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }
        
        // Mostrar el modal si es necesario al cargar la página
        window.onload = function() {
            var modal = document.getElementById("myModal");
            if (<?php echo $mostrar_modal ? 'true' : 'false'; ?>) {
                modal.style.display = "block";
            }
        }
    </script>
</body>
</html>
