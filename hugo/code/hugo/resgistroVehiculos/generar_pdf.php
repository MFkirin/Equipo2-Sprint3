<?php
require('fpdf/fpdf.php');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombreVehiculo = $_POST["nombre-vehiculo"];
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $matricula = $_POST["matricula"];
    $kilometro = $_POST["kilometro"] . ' Km';
    $precioCompra = $_POST["precComp"] . ' euros';
    $precioVenta = $_POST["precVenta"] . ' euros';
    $iva = $_POST["IVA"] . '%';
    $fechaMatriculacion = $_POST["fPrimerMatric"];
    $dañosObservados = $_POST["danoObs"];
    $descripcionComercial = $_POST["desCom"];
    $imagen_url = $_POST["imagen_url"];

    class PDFs extends FPDF
    {
        function Header()
        {
            $this->SetFont('Arial', 'B', 16);
            $this->Cell(0, 15, mb_convert_encoding('Informe del vehículo', 'ISO-8859-1'), 0, 1, 'C');
        }

        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, mb_convert_encoding('Página ' . $this->PageNo(), to_encoding: 'ISO-8859-1'), 0, 0,);
        }
    }

    $pdf = new PDFs();
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 12);

    $pdf->Cell(75, 10, mb_convert_encoding('Nombre del vehículo:', 'ISO-8859-15'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($nombreVehiculo, 'ISO-8859-15'), 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(75, 10, mb_convert_encoding('Marca:', 'ISO-8859-15'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($marca, 'ISO-8859-15'), 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(75, 10, mb_convert_encoding('Modelo:', 'ISO-8859-15'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($modelo, 'ISO-8859-15'), 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(75, 10, mb_convert_encoding('Matrícula:', 'ISO-8859-15'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($matricula, 'ISO-8859-15'), 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(75, 10, mb_convert_encoding('Kilómetros:', 'ISO-8859-15'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($kilometro, 'ISO-8859-15'), 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(75, 10, mb_convert_encoding('Precio de Compra:', 'ISO-8859-15'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($precioCompra, 'ISO-8859-15'), 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(75, 10, mb_convert_encoding('Precio de Venta:', 'ISO-8859-15'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($precioVenta, 'ISO-8859-15'), 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(75, 10, mb_convert_encoding('IVA:', 'ISO-8859-15'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($iva, 'ISO-8859-15'), 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(75, 10, mb_convert_encoding('Fecha de Primera Matrícula:', 'ISO-8859-15'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($fechaMatriculacion, 'ISO-8859-15'), 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(75, 10, mb_convert_encoding('Daños Observados:', 'ISO-8859-15'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($dañosObservados, 'ISO-8859-15'), 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(75, 10, mb_convert_encoding('Descripción Comercial:', 'ISO-8859-15'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, mb_convert_encoding($descripcionComercial, 'ISO-8859-15'), 0, 1, 'L');

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(75, 10, mb_convert_encoding('Image del vehículo:', 'ISO-8859-15'), 0, 0, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 15, mb_convert_encoding(''/* Aquí puedes agregar un texto opcional si lo deseas */, 'ISO-8859-15'), 0, 1);
    $pdf->Image($imagen_url, null, null, 100, 0, 'JPG');

    header('Content-Type: application/pdf');
    $pdf->Output();
}
