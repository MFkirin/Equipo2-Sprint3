<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require 'src/Provider.php';
require 'src/lib/ValidateProvider.php';
require 'BBDD/dbConfig.php';
require 'src/DataBase.php';

global $dbConfig;

try {
    $db = new DataBase($dbConfig);
} catch (Exception $exception) {
    die("Error de conexión a la base de datos: " . $exception->getMessage());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['csrf']) || $_POST['csrf'] !== $_SESSION['csrf']) {
        throw new TokenCSRFException("Token CSRF no válido. La solicitud ha sido rechazada.");
    }

    $errores = [];
    $validador = new ValidateProvider();

    $errores = ValidateProvider::validate($_POST);

    if (empty(array_filter($errores))) {
        try {
            $provider = new Provider();
            $provider->setName($_POST["name"]);
            $provider->setCompleteAddress($_POST["completeAddress"]);
            $provider->setDni($_POST["dni"]);
            $provider->setPhone($_POST["phone"]);
            $provider->setEmail($_POST["email"]);
            $provider->setCIF($_POST["CIF"]);
            $provider->setManagerNIF($_POST["managerNIF"]);

            if ($db->insertProvider($provider)) {
                echo "Datos del proveedor insertados correctamente en la base de datos.";
            } else {
                echo "Error al insertar los datos del proveedor.";
            }
        } catch (Exception $exception) {
            echo "Error al insertar los datos del proveedor: " . $exception->getMessage();
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Detalles de Proveedor</title>
        </head>
        <body>
        <h1>Detalles de Proveedor</h1>
        <form action="provider_pdf.php" method="post">
            <table>
                <tr>
                    <td>Nombre</td>
                    <td><?= $provider->getName() ?></td>
                    <input type="hidden" name="name" value="<?= $provider->getName() ?>">
                </tr>
                <tr>
                    <td>Domicilio</td>
                    <td><?= $provider->getCompleteAddress() ?></td>
                    <input type="hidden" name="completeAddress" value="<?= $provider->getCompleteAddress() ?>">
                </tr>
                <tr>
                    <td>DNI</td>
                    <td><?= $provider->getDni() ?></td>
                    <input type="hidden" name="dni" value="<?= $provider->getDni() ?>">
                </tr>
                <tr>
                    <td>Teléfono</td>
                    <td><?= $provider->getPhone() ?></td>
                    <input type="hidden" name="phone" value="<?= $provider->getPhone() ?>">
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?= $provider->getEmail() ?></td>
                    <input type="hidden" name="email" value="<?= $provider->getEmail() ?>">
                </tr>
                <tr>
                    <td>CIF</td>
                    <td><?= $provider->getCIF() ?></td>
                    <input type="hidden" name="CIF" value="<?= $provider->getCIF() ?>">
                </tr>
                <tr>
                    <td>NIF del Gerente</td>
                    <td><?= $provider->getManagerNIF() ?></td>
                    <input type="hidden" name="managerNIF" value="<?= $provider->getManagerNIF() ?>">
                </tr>
            </table>
            <button type="submit" name="generarPDF">Generar PDF</button>
        </form>
        <a href="index.php">
            <button>Volver a la lista</button>
        </a>
        </body>
        </html>
        <?php
    } else {
        foreach ($errores as $error) {
            echo "<p>$error</p>";
        }
    }
}