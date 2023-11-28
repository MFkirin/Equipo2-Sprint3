<?php
require('fpdf/fpdf186/fpdf.php');
session_start();
include 'Empleado.php';
//include 'FormRegistAdmin.php';
$ID = rand(0,1000);
$nombre = $_POST['nombre'];
$apellido = $_POST['Apellido'];
$tipo = "Empleado";
$email = $_POST['correo'];
$contrasena = $_POST['Contraseña'];
$confirmarCon = $_POST["confirmarContraseña"];


if ($_SERVER['REQUEST_METHOD'] == "POST"){
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Nombre='.$nombre,1,1);
$pdf->Cell(40,10,'Apellido='.$apellido,1,1);
$pdf->Cell(40,10,'Tipo='.$tipo,1,1);
$pdf->Cell(40,10,'Email='.$email,1,1);
$pdf->Output();
}
?>