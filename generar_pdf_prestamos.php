<?php
session_start();

// Incluir archivos necesarios
require_once "./php/main.php";
require_once 'fpdf/fpdf.php';

// Establecer conexión a la base de datos
$conexion = conexion();

// Consulta SQL para obtener los datos de los préstamos
$consulta = "SELECT prestamos.*, profesores.profesor_nombre, profesores.profesor_apellido, producto.producto_nombre
             FROM prestamos
             INNER JOIN profesores ON prestamos.profesor_id = profesores.profesor_id
             INNER JOIN producto ON prestamos.producto_id = producto.producto_id
             ORDER BY prestamos.fecha_solicitud DESC"; // Ordenar por fecha de solicitud descendente
$resultado = $conexion->query($consulta);

// Inicializar el PDF
$pdf = new FPDF();
$pdf->AddPage('P', 'A4'); // Orientación: Retrato (P), Tamaño: A4

// Obtener dimensiones de la página
$anchoPagina = $pdf->GetPageWidth();
$altoPagina = $pdf->GetPageHeight();

// Ajustar dimensiones y fuentes proporcionalmente
$tamañoFuenteTitulo = $anchoPagina * 0.04;
$tamañoFuenteCelda = $anchoPagina * 0.025;
$alturaCelda = $tamañoFuenteCelda * 1.5;

// Establecer márgenes (10% del ancho de la página)
$margen = $anchoPagina * 0.1;
$pdf->SetMargins($margen, $margen, $margen); 

// Añadir el logo (asegúrate de que la ruta y el nombre del archivo sean correctos)
$logoPath = './img/logo3.png'; // Ajusta la ruta y el nombre del archivo
if (file_exists($logoPath)) {
    $pdf->Image($logoPath, $margen, $margen, $anchoPagina * 0.1); // Ajusta las dimensiones según sea necesario
} else {
    die('Error: El archivo de logo no se encontró.');
}
$pdf->Ln($alturaCelda * 2); // Salto de línea después del logo

// Configuración de fuentes
$pdf->SetFont('Arial', 'B', $tamañoFuenteTitulo);

// Título del PDF
$pdf->Cell(0, $alturaCelda, 'Lista de Prestamos', 0, 1, 'C');
$pdf->Ln($alturaCelda); // Salto de línea

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', $tamañoFuenteCelda);
$pdf->Cell($anchoPagina * 0.15, $alturaCelda, 'Profesor', 1, 0, 'C');
$pdf->Cell($anchoPagina * 0.15, $alturaCelda, 'Producto', 1, 0, 'C');
$pdf->Cell($anchoPagina * 0.08, $alturaCelda, 'Cantidad', 1, 0, 'C');
$pdf->Cell($anchoPagina * 0.24, $alturaCelda, 'Fecha Solicitud', 1, 0, 'C');
$pdf->Cell($anchoPagina * 0.24, $alturaCelda, 'Fecha Devolucion', 1, 1, 'C');

// Iterar sobre los datos de los préstamos y agregar al PDF
$pdf->SetFont('Arial', '', $tamañoFuenteCelda);
while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
    // Agregar contenido de cada fila a la tabla
    $pdf->Cell($anchoPagina * 0.15, $alturaCelda, $fila['profesor_nombre'] . ' ' . $fila['profesor_apellido'], 1);
    $pdf->Cell($anchoPagina * 0.15, $alturaCelda, $fila['producto_nombre'], 1);
    $pdf->Cell($anchoPagina * 0.25, $alturaCelda, $fila['cantidad'], 1);
    $pdf->Cell($anchoPagina * 0.14, $alturaCelda, $fila['fecha_solicitud'], 1);
    $pdf->Cell($anchoPagina * 0.18, $alturaCelda, $fila['fecha_devolucion'], 1);
    $pdf->Ln();
}

// Ruta donde se guardará el PDF
$ruta_pdf = './pdf/lista_prestamos.pdf';

// Guardar el PDF en la ruta especificada
$pdf->Output($ruta_pdf, 'F');

// Redirigir de vuelta a la página de inicio con un mensaje de éxito
header("Location: ./index.php?vista=home&success=true&message=" . urlencode("El PDF se guardó con éxito"));
exit();
?>
