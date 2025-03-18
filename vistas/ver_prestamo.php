<div class="container">
    <h1 class="title has-text-centered">Prestamos</h1>
    <h2 class="subtitle has-text-centered">Lista de prestamos</h2>
    <div class="text-center has-text-centered"> <!-- Agrega la clase 'has-text-centered' aquí -->
        <a href="generar_pdf_prestamos.php" class="button is-primary">Descargar PDF de prestamos</a>
    </div>
   
</div>


    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F4F4F4;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #FFFFFF;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #008CBA;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .button:hover {
            background-color: #005f73;
        }
        .fecha-anterior {
            background-color: #ffcccc; /* Color de fondo para fechas anteriores */
        }
    </style>
</head>

<div class="container pb-6 pt-6">
    <?php
        require_once "./php/main.php";

        if (!isset($_GET['page'])) {
            $pagina = 1;
        } else {
            $pagina = (int)$_GET['page'];
            if ($pagina <= 1) {
                $pagina = 1;
            }
        }

        $categoria_id = (isset($_GET['category_id'])) ? $_GET['category_id'] : 0;

        $pagina = limpiar_cadena($pagina);
        $url = "index.php?vista=product_list&page="; /* <== */
        $registros = 15;
        $busqueda = "";

        # Paginador producto #
        require_once "./php/prestamos_lista.php";

        
    ?>
</div>




<!DOCTYPE html>
    <html>

        <script>
        // Esperar a que el documento esté completamente cargado
        document.addEventListener('DOMContentLoaded', function () {
            // Seleccionar todas las celdas de fecha vencida que tienen la clase fecha-anterior-tooltip
            const tooltips = document.querySelectorAll('.fecha-anterior-tooltip');

            // Iterar sobre cada tooltip y agregar la funcionalidad de tooltip
            tooltips.forEach(function (tooltip) {
                // Agregar un evento 'mouseover' para mostrar el tooltip al pasar el cursor
                tooltip.addEventListener('mouseover', function () {
                    // Mostrar el mensaje del tooltip utilizando el atributo 'title'
                    const mensaje = tooltip.getAttribute('title');
                    if (mensaje) {
                        alert(mensaje); // Mostrar el mensaje emergente (puedes usar un tooltip más sofisticado)
                    }
                });
            });
        });
    </script>

   