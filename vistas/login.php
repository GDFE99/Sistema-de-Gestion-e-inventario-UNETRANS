<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
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

        .login-form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            animation: fadeInUp 0.5s ease-in-out;
        }

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

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 200px; /* Aumenta el tamaño del logo */
            height: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Agrega una sombra suave */
        }

        .login-form .label {
            color: #363636;
            font-weight: bold;
        }

        .login-form .button {
            margin-top: 20px;
            width: 100%;
        }

        .login-form .button.is-info {
            background-color: #3498db;
            border-color: #3498db;
        }

        .login-form .button.is-info:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .forgot-password {
            text-align: center;
            margin-top: 10px;
        }

        .forgot-password a {
            color: #363636;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <form class="box login-form" action="" method="POST" autocomplete="off">
            <h5 class="title is-5 has-text-centered is-uppercase">Sistema de inventario Dpto. Electricidad</h5>
            <div class="logo">
                <img src="./img/logo3.png" alt="Logo">
            </div>
            <div class="field">
                <label class="label">Usuario</label>
                <div class="control">
                    <input class="input" type="text" name="login_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
                </div>
            </div>
            <div class="field">
                <label class="label">Contraseña</label>
                <div class="control">
                    <input class="input" type="password" name="login_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-info is-rounded">Iniciar sesión</button>
                </div>
            </div>
            <p class="has-text-centered forgot-password">
            <br><a href="vistas/pasword_res.php">¿Olvidaste tu contraseña?</a></br>
            </p>
            <?php
                if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
                    require_once "./php/main.php";
                    require_once "./php/iniciar_sesion.php";
                }
            ?>
        </form>
    </div>
</body>
</html>
