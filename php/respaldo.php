<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['backup'])) {
    // Configuración de la base de datos
    $host = 'localhost';
    $dbname = 'pdo';
    $username = 'root';
    $password = '';

    // Establecer conexión con la base de datos
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para obtener todas las tablas en la base de datos
        $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

        // Iniciar el contenido del archivo SQL de respaldo
        $backupContent = '';

        // Iterar sobre todas las tablas
        foreach ($tables as $table) {
            // Consulta para obtener la estructura y datos de cada tabla
            $stmt = $pdo->query("SELECT * FROM $table");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Generar la estructura y datos de la tabla en el archivo SQL
            $backupContent .= "DROP TABLE IF EXISTS $table;\n";
            $createTableSql = $pdo->query("SHOW CREATE TABLE $table")->fetchColumn(1);
            $backupContent .= "$createTableSql;\n";

            foreach ($rows as $row) {
                $rowValues = implode("', '", array_map('addslashes', $row));
                $backupContent .= "INSERT INTO $table VALUES ('$rowValues');\n";
            }

            $backupContent .= "\n";
        }

        // Guardar el contenido en un archivo SQL de respaldo
        $backupPath = 'C:/xampp/htdocs/proyecto/respaldoDB/';
        $backupFile = 'backup_' . date('Ymd_His') . '.sql';
        file_put_contents($backupPath . $backupFile, $backupContent);

        $message = "Respaldo creado correctamente: {$backupFile}";
    } catch (PDOException $e) {
        $message = "Error al crear el respaldo: " . $e->getMessage();
    }
} else {
    $message = "Presiona el botón 'Guardar Respaldo' para generar un respaldo.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Respaldar Base de Datos</title>
    <link rel="stylesheet" href="./css/bulma.min.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
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
        <h1>Respaldar Base de Datos</h1>
        <p><?php echo $message; ?></p>
        <p><a href="javascript:history.back()">Volver</a></p>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Respaldo</title>
</head>
<body>
<div class="container">
    <h1>Generar Respaldo de Base de Datos</h1>
    <form action="respaldo.php" method="post">
        <input type="submit" name="backup" value="Guardar Respaldo">
    </form>
    </div>
</body>
</html>
