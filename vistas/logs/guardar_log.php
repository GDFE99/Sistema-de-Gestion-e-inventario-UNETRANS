<?php
// Verificar si se recibió el contenido del log
if (isset($_POST['log_content'])) {
    // Obtener el contenido del log desde el formulario
    $log_content = $_POST['log_content'];

    // Establecer la conexión a la base de datos
    require_once "./php/main.php"; // Incluir el archivo de log

    try {
        // Insertar el contenido del log en la base de datos
        $stmt = $pdo->prepare("INSERT INTO logs (log_content) VALUES (:log_content)");
        $stmt->bindParam(':log_content', $log_content);
        $stmt->execute();

        echo 'Log guardado correctamente en la base de datos.';
    } catch (PDOException $e) {
        die("Error en la conexión a la base de datos: " . $e->getMessage());
    }
} else {
    // Redireccionar si se intenta acceder directamente a este archivo sin datos de log
    header("Location: formulario_guardar_log.php");
    exit();
}
?>
