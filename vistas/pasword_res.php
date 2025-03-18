<?php require "../inc/session_start.php"; ?>
<!DOCTYPE html>
<div class="main-container" style="background: linear-gradient(to bottom, #3498db, #ffffff);">
<html>
<head>
    <link rel="stylesheet" href="../css/bulma.min.css"> <!-- Ajusta la ruta al archivo CSS de Bulma -->
    <link rel="stylesheet" href="../css/estilos.css"> <!-- Ajusta la ruta si es necesario -->
</head>
<body>
    <div class="main-container">
        <form class="box login" action="cambiar_contrasena.php" method="POST" autocomplete="off">
            <h5 class="title is-5 has-text-centered is-uppercase">Restablecer contraseña</h5>
            <div class="field">
                <label class="label">Usuario</label>
                <div class="control">
                    <input class="input" type="text" name="usuario" maxlength="20" required>
                </div>
            </div>
            <p class="has-text-centered mb-4 mt-3">
                <button type="submit" class="button is-info is-rounded">Verificar usuario</button>
            </p>
        </form>
    </div>
</body>
</html>


<?php
require_once "../php/main.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = limpiar_cadena($_POST["usuario"]);

    // Consultar la base de datos para verificar si el usuario existe
    $sql = "SELECT COUNT(*) AS count FROM usuario WHERE usuario_usuario = '$usuario'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $count = $row['count'];

        if ($count > 0) {
            // Usuario encontrado, redirigir a cambiar_contrasena.php con el usuario como parámetro
            header("Location: cambiar_contrasena.php?usuario=$usuario");
            exit;
        } else {
            // Usuario no encontrado
            echo "Usuario no encontrado en la base de datos. Por favor, inténtalo de nuevo.";
        }
    } else {
        // Error en la consulta
        echo "Error al consultar la base de datos.";
    }
}
?>
