<!DOCTYPE html>
<html lang="es">
<head>
<div class="main-container" style="background: linear-gradient(to bottom, #3498db, #ffffff);">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <!-- Referencia a los archivos CSS locales de Bulma -->
    <head>
    <link rel="stylesheet" href="../css/bulma.min.css"> <!-- Ajusta la ruta al archivo CSS de Bulma -->
    <link rel="stylesheet" href="../css/estilos.css"> <!-- Ajusta la ruta si es necesario -->
</head>
    <style>
        /* Estilos adicionales personalizados si es necesario */
        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <form class="box login" action="guardar_contrasena.php" method="POST" autocomplete="off">
            <h5 class="title is-5 has-text-centered is-uppercase">Cambiar Contraseña</h5>
            <input type="hidden" name="usuario" value="<?php echo htmlspecialchars($_GET['usuario']); ?>">
            <div class="field">
                <label class="label">Nueva Contraseña</label>
                <div class="control">
                    <input class="input" type="password" name="nueva_contrasena" minlength="8" maxlength="100" required>
                </div>
            </div>
            <p class="has-text-centered mt-4">
                <button type="submit" class="button is-info is-rounded">Guardar Contraseña</button>
            </p>
        </form>
    </div>
</body>
</html>

