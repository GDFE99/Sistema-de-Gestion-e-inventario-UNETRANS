<?php
// Incluir la biblioteca FPDF
require_once('fpdf/fpdf.php');

// Función para generar un PDF a partir del archivo de registro
function generarPDFLogs() {
    $archivo = 'logs/app.log'; // Ruta al archivo de registro

    // Crear una instancia de FPDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Configurar la fuente y tamaño del texto
    $pdf->SetFont('Arial', '', 12);

    // Leer el contenido del archivo de registro
    if (file_exists($archivo)) {
        $contenido = file_get_contents($archivo);

        // Agregar el contenido al PDF
        $pdf->MultiCell(0, 10, $contenido);

        // Nombre del archivo PDF generado
        $nombreArchivo = 'log.pdf';

        // Salida del PDF al navegador para descarga
        $pdf->Output($nombreArchivo, 'D');
    } else {
        echo 'No se encontró el archivo de registro.';
    }
}

// Llamar a la función para generar el PDF
generarPDFLogs();
?>
