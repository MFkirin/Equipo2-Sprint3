<?php
require '../classesPhP/Factura.php';
require '../classesPhP/FacturaCRUD.php';
require_once '../classesPhP/config-base-dades.php';

$pdo = obtenerConexionPDO();

$facturaCRUD = new FacturaCRUD($pdo);
$facturas = $facturaCRUD->getAllFacturas();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Listado de Facturas</title>
</head>
<body>
<h1>Listado de Facturas</h1>

<ul>
    <?php foreach ($facturas as $factura): ?>
        <li>
            <div>
                <a href="factura-detalles.php?id=<?= $factura->getNumFactura() ?>">
                    Factura ID: <?= $factura->getNumFactura() ?>
                </a>
            </div>
            <ul>
                <li>Precio: <?= $factura->getPreu() ?></li>
                <li>Fecha: <?= $factura->getDataAsString() ?></li>
                <li>DNI Usuario: <?= $factura->getClient() ?></li>
                <li>ID Comanda: <?= $factura->getComanda() ?></li>
            </ul>
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>
