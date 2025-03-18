<?php
session_start();

require_once "./php/main.php";
require_once 'fpdf/fpdf.php';

try {
    // Nombre del archivo PDF a generar
    $outputFileName = './pdf/auditoria.pdf'; // Ruta completa hacia la carpeta pdf

    // Establecer conexión a la base de datos
    $conexion = conexion();

    // Consulta SQL para obtener los datos de los logs de auditoría
    $consulta = "SELECT * FROM auditoria ORDER BY fecha DESC"; // Ordenar por fecha descendente
    $resultado = $conexion->query($consulta);

    // Verificar si hay resultados
    if ($resultado->rowCount() > 0) {
        // Crear instancia de FPDF
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
        $pdf->Cell(0, $alturaCelda, 'Registro de Auditoria', 0, 1, 'C');
        $pdf->Ln($alturaCelda); // Salto de línea

        // Encabezados de la tabla
        $pdf->SetFont('Arial', 'B', $tamañoFuenteCelda);
        $pdf->Cell($anchoPagina * 0.05, $alturaCelda, 'ID', 1, 0, 'C');
        $pdf->Cell($anchoPagina * 0.10, $alturaCelda, 'Usuario ID', 1, 0, 'C');
        $pdf->Cell($anchoPagina * 0.15, $alturaCelda, 'Usuario', 1, 0, 'C');
        $pdf->Cell($anchoPagina * 0.15, $alturaCelda, 'Tabla Afectada', 1, 0, 'C');
        $pdf->Cell($anchoPagina * 0.15, $alturaCelda, 'Operacion', 1, 0, 'C');
        $pdf->Cell($anchoPagina * 0.20, $alturaCelda, 'Fecha', 1, 0, 'C');
        $pdf->Cell($anchoPagina * 0.20, $alturaCelda, 'Detalle', 1, 1, 'C');

        // Configura la fuente para el contenido
        $pdf->SetFont('Arial', '', $tamañoFuenteCelda);

        // Iterar sobre los datos de los logs y agregar al PDF
        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $pdf->Cell($anchoPagina * 0.05, $alturaCelda, $fila['id'], 1);
            $pdf->Cell($anchoPagina * 0.10, $alturaCelda, $fila['usuario_id'], 1);
            $pdf->Cell($anchoPagina * 0.15, $alturaCelda, $fila['usuario_usuario'], 1);
            $pdf->Cell($anchoPagina * 0.15, $alturaCelda, $fila['tabla_afectada'], 1);
            $pdf->Cell($anchoPagina * 0.15, $alturaCelda, $fila['operacion'], 1);
            $pdf->Cell($anchoPagina * 0.20, $alturaCelda, $fila['fecha'], 1);
            $pdf->Cell($anchoPagina * 0.20, $alturaCelda, $fila['detalle'], 1);
            $pdf->Ln();
        }

        // Guardar el PDF en la carpeta pdf
        $pdf->Output('F', $outputFileName);

        // Establecer mensaje de éxito
        $_SESSION['success_message'] = "¡El PDF se generó correctamente!";

        // Redirigir de vuelta a index.php?vista=home con el nombre del archivo PDF
        $redirectUrl = "/proyecto/index.php?vista=home&success=true&message=El%20PDF%20se%20guardó%20con%20éxito";
        
        header("Location: $redirectUrl");
        exit();
    } else {
        // No hay registros de auditoría
        throw new Exception('No hay registros de auditoría.');
    }
} catch (Exception $e) {
    // Capturar errores y mostrar mensaje
    $_SESSION['error_message'] = "Error al generar el PDF: " . $e->getMessage();
    header("Location: /proyecto/index.php?vista=ver_logs");
    exit();
}
?>
