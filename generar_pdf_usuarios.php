<?php
session_start();

require_once "./php/main.php";
require_once 'fpdf/fpdf.php'; // Incluye la biblioteca FPDF

// Realizar la conexión a la base de datos
$conexion = conexion(); // Esto depende de cómo estés manejando la conexión a la base de datos

// Realizar la consulta para obtener los datos de los usuarios
$consulta = $conexion->query("SELECT * FROM usuario");
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
    $pdf->Cell(0, $alturaCelda, 'Lista de Usuarios', 0, 1, 'C');
    $pdf->Ln($alturaCelda); // Salto de línea

    // Encabezados de la tabla
    $pdf->SetFont('Arial', 'B', $tamañoFuenteCelda);
    $pdf->Cell($anchoPagina * 0.18, $alturaCelda, 'Nombre', 1, 0, 'C');
    $pdf->Cell($anchoPagina * 0.15, $alturaCelda, 'Usuario', 1, 0, 'C');
    $pdf->Cell($anchoPagina * 0.25, $alturaCelda, 'Email', 1, 0, 'C');
    $pdf->Cell($anchoPagina * 0.14, $alturaCelda, 'Cedula', 1, 0, 'C');
    $pdf->Cell($anchoPagina * 0.18, $alturaCelda, 'Departamento', 1, 1, 'C');

    // Configura la fuente para el contenido
    $pdf->SetFont('Arial', '', $tamañoFuenteCelda);

    // Itera sobre los datos de los usuarios y agrega al PDF
    foreach ($datos as $row) {
        $pdf->Cell($anchoPagina * 0.18, $alturaCelda, $row['usuario_nombre'] . ' ' . $row['usuario_apellido'], 1);
        $pdf->Cell($anchoPagina * 0.15, $alturaCelda, $row['usuario_usuario'], 1);
        $pdf->Cell($anchoPagina * 0.25, $alturaCelda, $row['usuario_email'], 1);
        $pdf->Cell($anchoPagina * 0.14, $alturaCelda, $row['usuario_cedula'], 1);
        $pdf->Cell($anchoPagina * 0.18, $alturaCelda, $row['usuario_departamento'], 1);
        $pdf->Ln();
    }

    // Generar el PDF
    $pdf->Output('D', 'lista_usuarios.pdf'); // Descargar el PDF directamente

} else {
    echo "No se encontraron usuarios en la base de datos.";
}

?>
