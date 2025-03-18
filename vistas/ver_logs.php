<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs del sistema</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F4F4F4;
            text-align: center;
        }
        h1 {
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
        .log-container {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: auto;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button {
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="title has-text-centered">Logs del sistema</h1>
        <div class="button-container">
            <form action="generar_pdf.php" method="post">
                <button type="submit" name="generate_pdf" class="button is-link is-rounded is-small">Generar PDF</button>
            </form>
        </div>

        <?php
        // Incluye el archivo main.php si es necesario
        require_once "./php/main.php";

        // Función para mostrar logs desde la base de datos con paginación
        function mostrarLogsDesdeBD($pagina, $registrosPorPagina) {
            // Detalles de conexión a la base de datos
            $hostname = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'pdo';

            // Establece la conexión
            $conn = new mysqli($hostname, $username, $password, $database);
            // Verifica la conexión
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Calcula el offset para la paginación
            $offset = ($pagina - 1) * $registrosPorPagina;

            // Consulta SQL para obtener logs con límite y offset
            $sql = "SELECT * FROM auditoria LIMIT $offset, $registrosPorPagina";
            $result = $conn->query($sql);

            // Verifica si hay resultados
            if ($result->num_rows > 0) {
                // Muestra los logs en una tabla
                echo '<div class="log-container">';
                echo '<table>';
                echo '<tr><th>ID</th><th>Usuario ID</th><th>Usuario Usuario</th><th>Tabla Afectada</th><th>Operacion</th><th>Fecha</th><th>Detalle</th></tr>';
                // Muestra los datos de cada fila
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['id']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['usuario_id']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['usuario_usuario']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['tabla_afectada']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['operacion']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['fecha']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['detalle']) . '</td>';
                    echo '</tr>';
                }
                echo '</table>';
                echo '</div>';
            } else {
                echo '<p>No se encontraron registros en la base de datos.</p>';
            }

            // Cierra la conexión
            $conn->close();
        }

        // Función para obtener el total de registros
        function obtenerTotalRegistros() {
            // Detalles de conexión a la base de datos
            $hostname = 'localhost';
            $username = 'root';
            $password = '';
            $database = 'pdo';

            // Establece la conexión
            $conn = new mysqli($hostname, $username, $password, $database);
            // Verifica la conexión
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Consulta SQL para contar el total de registros
            $sql = "SELECT COUNT(*) AS total FROM auditoria";
            $result = $conn->query($sql);
            $total = 0;

            // Verifica si hay resultados
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $total = $row['total'];
            }

            // Cierra la conexión
            $conn->close();
            return $total;
        }

        // Obtiene el número de página actual (desde un parámetro GET)
        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $registrosPorPagina = 12; // Número de registros por página
        $totalRegistros = obtenerTotalRegistros();
        $Npaginas = ceil($totalRegistros / $registrosPorPagina); // Número total de páginas
        $url = 'index.php?vista=ver_logs&pagina='; // URL base para la paginación
        $botones = 5; // Cantidad de botones a mostrar en el paginador

        // Llama a la función para mostrar los logs de la página actual
        mostrarLogsDesdeBD($pagina, $registrosPorPagina);

        // Muestra el paginador de tablas
        echo '<div class="button-container">';
        for ($i = max(1, $pagina - $botones); $i <= min($pagina + $botones, $Npaginas); $i++) {
            echo '<a href="' . $url . $i . '" class="button">' . $i . '</a>';
        }
        echo '</div>';
        ?>
    </div>
</body>
</html>
