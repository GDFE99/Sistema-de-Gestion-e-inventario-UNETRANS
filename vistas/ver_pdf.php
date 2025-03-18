<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F4F4F4;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #FFFFFF;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
        }
        ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: left;
        }
        li {
            font-size: 16px;
            color: #666;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Archivos PDF Disponibles:</h1>
        <?php
        // Directorio donde se encuentran los archivos PDF
        $directorio = './pdf/';

        // Escanear el directorio en busca de archivos PDF
        $archivos = glob($directorio . '*.pdf');

        // Verificar si se encontraron archivos PDF
        if (count($archivos) > 0) {
           
            echo '<ul>';
            foreach ($archivos as $archivo) {
                // Obtener solo el nombre del archivo sin la ruta completa
                $nombreArchivo = basename($archivo);
                echo '<li><a href="' . $archivo . '" target="_blank">' . $nombreArchivo . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No se encontraron archivos PDF.</p>';
        }
        ?>
        <p>Por favor, selecciona un archivo PDF para ver en una nueva pestaña del navegador.</p>
    </div>
</body>
</html>


