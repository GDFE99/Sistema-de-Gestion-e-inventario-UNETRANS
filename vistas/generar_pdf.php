<?php
// Definir las variables de conexión a la base de datos
$host = "localhost";  // Nombre del servidor de la base de datos (puede ser "localhost" u otra dirección IP)
$dbname = "pdo";  // Nombre de tu base de datos
$username = "root";  // Nombre de usuario de la base de datos
$password = "";  // Contraseña de la base de datos

try {
    // Crear la conexión PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener el contenido de los logs desde la base de datos
    $sql = "SELECT log_content FROM logs";
    $stmt = $pdo->query($sql);
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Crear el PDF utilizando FPDF
    require('fpdf/fpdf.php');
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);

    foreach ($logs as $log) {
        $pdf->MultiCell(0, 10, $log['log_content']);
    }

    // Nombre del archivo PDF a descargar
    $outputFileName = 'logs.pdf';

    // Guardar el PDF en el servidor
    $pdf->Output('F', $outputFileName);

    // Mensaje de éxito y redirección
    session_start();
    $_SESSION['success_message'] = "¡El PDF se generó correctamente!";
    header("Location: ver_pdf.php");
    exit();
} catch (PDOException $e) {
    // Error al conectar a la base de datos o al ejecutar la consulta
    die("Error al conectar a la base de datos: " . $e->getMessage());
} catch (Exception $e) {
    // Otro tipo de error
    die("Error inesperado: " . $e->getMessage());
}
?>
