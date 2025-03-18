<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
</head>
<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="index.php?vista=home_admin">
                <img src="./img/logo2.png" alt="Logo" style="max-height: 100px; max-width: 150px; padding: 5px;">
            </a>
            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">Usuarios</a>
                    <div class="navbar-dropdown">
                        <a href="index.php?vista=user_new" class="navbar-item">Nuevo</a>
                        <a href="index.php?vista=user_list" class="navbar-item">Lista</a>
                        <a href="index.php?vista=user_search" class="navbar-item">Buscar</a>
                    </div>
                </div>         <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link ">Auditoria</a>
                        <div class="navbar-dropdown">
                            <a href="index.php?vista=ver_logs" class="navbar-item">Consultar auditoria</a>
                            <a href="index.php?vista=ver_pdf" class="navbar-item">Consultar pdf</a>
                            <a href="index.php?vista=database_res" class="navbar-item">Respaldar DB</a>

                        </div>
                        
                    </div>
                </div>
                <!-- Agrega más secciones específicas para administradores aquí -->
            </div>
            <div class="navbar-end">
                <div class="navbar-item user-info">
                    <img src="./img/user_icon.png" alt="User Avatar" style="height: 40px; width: 40px;">
                    <span><?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?></span>
                </div>
                <div class="navbar-item">
                    <div class="buttons">
                    <a href="index.php?vista=user_count&user_id_up=<?php echo $_SESSION['id']; ?>" class="button is-primary is-rounded">Mi cuenta</a>
                    <a href="index.php?vista=logout" class="button is-link is-rounded">Salir</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>
