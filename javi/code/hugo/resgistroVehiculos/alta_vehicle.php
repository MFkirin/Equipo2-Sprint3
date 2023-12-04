<?php

use Exceptions\TokenCSRFException;

session_start();

require 'src/Vehicle.php';
require 'src/Image.php';
require 'src/ValidarVehicle.php';

try {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
            throw new TokenCSRFException("Token CSRF no válido. La solicitud ha sido rechazada.");
        }

        $validador = new ValidarVehicle();
        $errores = $validador->validar($_POST, $_FILES);

        if (empty($errores)) {
 


            $imagen = $_FILES["imagen"];
            $imagenObj = new Image();
            $imagenObj->setNombre($imagen["name"]);
            $vehiculo->__set('imagen', $imagenObj);

            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($imagen["name"]);

            if (move_uploaded_file($imagen["tmp_name"], $targetFile)) {
                ?>
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Vehículo Details</title>
                    <link rel="stylesheet" href="./css/phpform.css">
                </head>
                <body>
                <h2>Vehículo Details</h2>
                <form action="generar_pdf.php" method="post">
                    <table>
                        <tr>
                            <th>Property</th>
                            <th>Value</th>
                        </tr>
                        <tr>
                            <td>Nombre del vehículo</td>
                            <td><?= $vehiculo->__get('nombre') ?></td>
                            <input type="hidden" name="nombre-vehiculo" value="<?= $vehiculo->__get('nombre') ?>">
                        </tr>
                        <tr>
                            <td>Marca</td>
                            <td><?= $vehiculo->__get('marca') ?></td>
                            <input type="hidden" name="marca" value="<?= $vehiculo->__get('marca') ?>">
                        </tr>
                        <tr>
                            <td>Modelo</td>
                            <td><?= $vehiculo->__get('modelo') ?></td>
                            <input type="hidden" name="modelo" value="<?= $vehiculo->__get('modelo') ?>">
                        </tr>
                        <tr>
                            <td>Matrícula</td>
                            <td><?= $vehiculo->__get('matricula') ?></td>
                            <input type="hidden" name="matricula" value="<?= $vehiculo->__get('matricula') ?>">
                        </tr>
                        <tr>
                            <td>Kilómetros</td>
                            <td><?= $vehiculo->__get('km') . ' Km' ?></td>
                            <input type="hidden" name="kilometro" value="<?= $vehiculo->__get('km') ?>">
                        </tr>
                        <tr>
                            <td>Precio de Compra</td>
                            <td><?= $vehiculo->__get('precioCompra') . '€' ?></td>
                            <input type="hidden" name="precComp" value="<?= $vehiculo->__get('precioCompra') ?>">
                        </tr>
                        <tr>
                            <td>Precio de Venta</td>
                            <td><?= $vehiculo->__get('precioVenta') . '€' ?></td>
                            <input type="hidden" name="precVenta" value="<?= $vehiculo->__get('precioVenta') ?>">
                        </tr>
                        <tr>
                            <td>IVA</td>
                            <td><?= $vehiculo->__get('iva') . '%' ?></td>
                            <input type="hidden" name="IVA" value="<?= $vehiculo->__get('iva') ?>">
                        </tr>
                        <tr>
                            <td>Fecha de Primera Matrícula</td>
                            <td><?= date('d-m-Y', strtotime($vehiculo->__get('fechaMatriculacion'))) ?></td>
                            <input type="hidden" name="fPrimerMatric"
                                   value="<?= date('d-m-Y', strtotime($vehiculo->__get('fechaMatriculacion'))) ?>">
                        </tr>
                        <tr>
                            <td>Daños observados</td>
                            <td><?= $vehiculo->__get('danoObservados') ?></td>
                            <input type="hidden" name="danoObs" value="<?= $vehiculo->__get('danoObservados') ?>">
                        </tr>
                        <tr>
                            <td>Descripción comercial</td>
                            <td><?= $vehiculo->__get('descripcionComercial') ?></td>
                            <input type="hidden" name="desCom" value="<?= $vehiculo->__get('descripcionComercial') ?>">
                        </tr>
                        <tr>
                            <td>Imagen</td>
                            <td><img src="<?= $targetFile ?>"></td>
                            <input type="hidden" name="imagen_url" value="<?= $targetFile ?>">
                        </tr>
                    </table>
                    <button type="submit" name="generarPDF">Generar PDF</button>
                </form>
                </body>
                </html>
                <?php
            } else {
                echo "Error al mover la imagen.";
            }
        } else {
            // Mostrar errores
            include 'errores.php';
        }
    }
} catch (TokenCSRFException $e) {
    echo "Error CSRF: " . $e->getMessage();
} catch (Exception $e) {
    echo "Ha ocurrido un error: " . $e->getMessage();
}
