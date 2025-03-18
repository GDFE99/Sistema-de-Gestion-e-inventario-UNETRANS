<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F4F4F4; /* Color de fondo para toda la página */
            text-align: center; /* Centra el texto en el cuerpo de la página */
        }
        .container {
            max-width: 800px;
            margin: 20px auto; /* Margen automático para centrar el contenedor */
            padding: 20px;
            background-color: #FFFFFF; /* Fondo blanco para el contenedor */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px; /* Espacio inferior para separar del siguiente contenido */
        }
        .form-rest {
            max-width: 500px;
            margin: 0 auto;
        }
        .select, .input, .button {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title has-text-centered">Categorías</h1>
        <h2 class="subtitle has-text-centered">Lista de categorías</h2>
    </div>

    <div class="container">
        <?php
        // Incluir el archivo main.php si es necesario
        require_once "./php/main.php";

        // Eliminar categoría si se ha pasado category_id_del por GET
        if (isset($_GET['category_id_del'])) {
            require_once "./php/categoria_eliminar.php";
        }

        // Establecer la página actual
        $pagina = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($pagina <= 1) {
            $pagina = 1;
        }

        // Limpiar la cadena de la página
        $pagina = limpiar_cadena($pagina);

        // URL base para la paginación
        $url = "index.php?vista=category_list&page=";

        // Número de registros por página
        $registros = 12;

        // Mostrar el paginador de categorías
        require_once "./php/categoria_lista.php";
        ?>
    </div>
</body>
</html>
