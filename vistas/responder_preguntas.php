<?php
// Verificar si se ha enviado un usuario válido a través de la URL
if (isset($_GET['usuario']) && !empty($_GET['usuario'])) {
    $usuario = $_GET['usuario'];

    // Conexión a la base de datos (reemplaza los valores con los tuyos)
    require_once "../php/main.php";

    // Consultar la base de datos para verificar si el usuario existe
    $sql = "SELECT usuario_id FROM usuario WHERE usuario_usuario = '$usuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuario encontrado, mostrar el formulario para responder las preguntas de seguridad
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responder Preguntas de Seguridad</title>
</head>
<body>
<style>
        /* Estilos adicionales personalizados si es necesario */
        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
    
    <div class="main-container">
        <form class="box login" action="validar_respuestas.php" method="POST">
            <h5 class="title is-5 has-text-centered is-uppercase">Responder Preguntas de Seguridad</h5>
            <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>">
            <div class="field">
                <label class="label">Pregunta 1</label>
                <div class="control">
                    <input class="input" type="text" name="pregunta1" maxlength="255" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Pregunta 2</label>
                <div class="control">
                    <input class="input" type="text" name="pregunta2" maxlength="255" required>
                </div>
            </div>
            <p class="has-text-centered mb-4 mt-3">
                <button type="submit" class="button is-info is-rounded">Verificar Respuestas</button>
            </p>
        </form>
    </div>
</body>
</html>
<?php
    } else {
        // Usuario no encontrado en la base de datos
        echo "Usuario no válido.";
    }
} else {
    // Redireccionar si no se proporcionó un usuario válido en la URL
    header("Location: ingresar_usuario.php");
    exit;
}
?>
