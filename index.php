<?php

require 'FPDF/fpdf.php';

// Datos de conexión
$mysqli = new mysqli("localhost", "root", "", "pruebas");

if(mysqli_connect_errno()) {
	echo 'Conexion fallida: ', mysqli_connect_errno();
	exit();
}

// Consulta
$query = "SELECT * FROM usuarios";
$resultado = $mysqli->query($query);

$pdf = new fpdf();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->setFillColor(232, 232, 232);
$pdf->setFont('Arial', 'B', 12);
$pdf->Cell(20, 6, 'ID', 1, 0, 'C', 1);
$pdf->Cell(80, 6, 'NOMBRE', 1, 0, 'C', 1);
$pdf->Cell(40, 6, 'TELEFONO', 1, 0, 'C', 1);
$pdf->Cell(50, 6, 'EMAIL', 1, 1, 'C', 1);

$pdf->setFont('Arial', '', 10);

while($fila = $resultado->fetch_assoc()) {
	$pdf->Cell(20, 6, $fila['idUsuario'], 1, 0, 'C');
	$pdf->Cell(80, 6, utf8_decode($fila['nombre']), 1, 0, 'C');
	$pdf->Cell(40, 6, utf8_decode($fila['telefono']), 1, 0, 'C');
	$pdf->Cell(50, 6, utf8_decode($fila['email']), 1, 1, 'C');
}

$pdf->Output();


?>