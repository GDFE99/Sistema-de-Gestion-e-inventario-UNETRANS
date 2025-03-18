<?php
session_start();

require_once "./php/main.php";
require_once 'fpdf/fpdf.php'; // Incluye la biblioteca FPDF

// Realizar la conexión a la base de datos
$conexion = conexion(); // Esto depende de cómo estés manejando la conexión a la base de datos

// Realizar la consulta para obtener los datos de los productos
$consulta = $conexion->query("SELECT p.*, c.categoria_nombre 
                              FROM producto p 
                              JOIN categoria c ON p.categoria_id = c.categoria_id");
$datos = $consulta->fetchAll(PDO::FETCH_ASSOC);

// Verificar si se obtuvieron datos antes de intentar generar el PDF
if ($datos) {
    // Inicializa la clase FPDF
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

    // Agrega el título centrado
    $pdf->Cell(0, $alturaCelda, 'Lista de Productos', 0, 1, 'C');
    $pdf->Ln($alturaCelda); // Salto de línea

    // Encabezados de la tabla
    $pdf->SetFont('Arial', 'B', $tamañoFuenteCelda);
    $pdf->Cell($anchoPagina * 0.20, $alturaCelda, 'Nombre', 1, 0, 'C');
    $pdf->Cell($anchoPagina * 0.20, $alturaCelda, 'Codigo', 1, 0, 'C');
    $pdf->Cell($anchoPagina * 0.15, $alturaCelda, 'Stock', 1, 0, 'C');
    $pdf->Cell($anchoPagina * 0.25, $alturaCelda, 'Categoria', 1, 0, 'C');
    $pdf->Cell($anchoPagina * 0.20, $alturaCelda, 'Imagen', 1, 1, 'C');

    // Configura la fuente para el contenido
    $pdf->SetFont('Arial', '', $tamañoFuenteCelda);

    // Itera sobre los datos de los productos y agrega al PDF
    foreach ($datos as $row) {
        $pdf->Cell($anchoPagina * 0.20, $alturaCelda, $row['producto_nombre'], 1);
        $pdf->Cell($anchoPagina * 0.20, $alturaCelda, $row['producto_codigo'], 1);
        $pdf->Cell($anchoPagina * 0.15, $alturaCelda, $row['producto_stock'], 1);
        $pdf->Cell($anchoPagina * 0.25, $alturaCelda, $row['categoria_nombre'], 1);
        
        if (is_file("./img/producto/" . $row['producto_foto'])) {
            $pdf->Cell($anchoPagina * 0.20, $alturaCelda, '', 1, 0, 'C');
            $pdf->Image("./img/producto/" . $row['producto_foto'], $pdf->GetX(), $pdf->GetY(), $anchoPagina * 0.20, $alturaCelda); // Ajustar posición y tamaño de la imagen
        } else {
            $pdf->Cell($anchoPagina * 0.20, $alturaCelda, 'Sin imagen', 1, 0, 'C'); // Celda de texto si no hay imagen
        }
        $pdf->Ln();
    }

    // Generar el PDF
    $pdf->Output('D', 'lista_productos.pdf'); // Descargar el PDF directamente

} else {
    echo "No se encontraron productos en la base de datos.";
}
?>
