<?php
require_once __DIR__ . '/vendor/autoload.php';

use Fpdf\Fpdf;

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST)) {
    // Crea el PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Agrega contenido al PDF utilizando los datos del formulario
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 15, 'Detalles de Factura', 0, 1, 'C');

    foreach ($_POST as $name => $value) {
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, ucfirst($name) . ':', 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, $value, 0, 1);
    }

    header('Content-Type: application/pdf');
    $pdf->Output();
    exit;
}

// Si llega a este punto, algo salió mal
echo 'Error al generar el PDF';