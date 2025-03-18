<div class="container">
    <h3 class="title has-text-centered">Productos</h3>
    <h2 class="subtitle has-text-centered">Lista de productos</h2>
    <div class="text-center"> <!-- Agrega un contenedor con clase "text-center" para centrar el botón -->
        <a href="generar_pdf_productos.php" class="button is-primary">Descargar PDF de Productos</a>
    </div>
    <style>
        .container {
            max-width: 800px;
            margin: 20px auto; /* Margen automático para centrar el contenedor */
            padding: 20px;
            background-color: #FFFFFF; /* Fondo blanco para el contenedor */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F4F4F4; /* Color de fondo para toda la página */
            text-align: center; /* Centra el texto en el cuerpo de la página */
        }
        .text-center {
            text-align: center; /* Centra el contenido del contenedor */
        }
        .form-rest {
            max-width: 500px;
            margin: 0 auto;
        }
        .select, .input, .button {
            margin-bottom: 10px;
        }
        .product-image {
            max-width: 50px; /* Establece el ancho máximo para las imágenes */
            height: auto; /* Permite ajustar automáticamente la altura */
        }
    </style>
</div>

    <?php
        // Incluye el archivo necesario para obtener y mostrar la lista de productos
        require_once "./php/main.php";

        // Verifica si se está intentando eliminar un producto
        if(isset($_GET['product_id_del'])){
            require_once "./php/producto_eliminar.php";
        }

        // Configura la página actual y la categoría seleccionada (si hay)
        $pagina = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int) $_GET['page'] : 1;
        $categoria_id = (isset($_GET['category_id']) && is_numeric($_GET['category_id'])) ? (int) $_GET['category_id'] : 0;

        // Limpia la cadena para prevenir inyección de código
        $pagina = limpiar_cadena($pagina);
        
        // URL base para el paginador
        $url = "index.php?vista=product_list&page=";

        // Número de registros por página
        $registros = 15;

        // Búsqueda (en caso de implementar un sistema de búsqueda)
        $busqueda = "";

        // Incluye el archivo que se encarga de mostrar la lista de productos paginada
        require_once "./php/producto_lista.php";
        
    ?>
</div>


<style>
    .product-image {
        width: 50px; /* Adjust the width as needed */
        height: auto; /* Maintain aspect ratio */
    }
</style>


