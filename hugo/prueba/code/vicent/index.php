<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require 'BBDD/dbConfig.php';
require 'src/DataBase.php';

global $dbConfig;

$db = new DataBase($dbConfig);

if (isset($_POST['deleteProvider'])) {
    $providerId = $_POST['providerId'];
    try {
        if ($db->deleteProvider($providerId)) {
            header("Location: index.php");
        } else {
            throw new Exception("Error al eliminar el proveedor.");
        }
    } catch (Exception $e) {
        $deleteError = $e->getMessage();
    }
}

if (isset($_POST['deleteVehicle'])) {
    $vehicleId = $_POST['vehicleId'];
    try {
        if ($db->deleteVehicle($vehicleId)) {
            header("Location: index.php");
        } else {
            throw new Exception("Error al eliminar el vehículo.");
        }
    } catch (Exception $e) {
        $deleteError = $e->getMessage();
    }
}

$providers = $db->getProviders();
$vehicles = $db->getVehicles();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Lista de Proveedores y Vehículos</title>
    <link rel="stylesheet" href="css/phpform.css">
</head>
<body>
<?php if (isset($deleteError)) { ?>
    <div><?= $deleteError ?></div>
<?php } ?>
<h3>Lista de Proveedores</h3>
<a href="provider_form.php">
    <button>Dar de Alta un Proveedor</button>
</a>
<table>
    <tr>
        <th></th>
        <th>ID</th>
        <th>Nombre</th>
        <th>DNI</th>
        <th>Documento LOPD</th>
        <th>NIF Gerente</th>
        <th>Documento Constitución</th>
        <th>CIF</th>
        <th>Certificado Cuenta Bancaria</th>
        <th>Domicilio Completo</th>
        <th>Teléfono</th>
        <th>Correo Electrónico</th>
    </tr>
    <?php
    if (!empty($providers)) {
        foreach ($providers as $provider): ?>
            <tr>
                <td>
                    <form action="index.php" method="post">
                        <input type="hidden" name="providerId" value="<?php echo $provider['id']; ?>">
                        <button type="submit" name="deleteProvider" onclick="return confirm('¿Estás seguro de que deseas eliminar este proveedor?')">Eliminar</button>
                    </form>
                </td>
                <td><?= $provider['id'] ?></td>
                <td><?= $provider['nombre'] ?></td>
                <td><?= $provider['DNI'] ?></td>
                <td><?= $provider['documento_LOPD'] ?></td>
                <td><?= $provider['NIF_Gerente'] ?></td>
                <td><?= $provider['documento_constitucion'] ?></td>
                <td><?= $provider['CIF'] ?></td>
                <td><?= $provider['certificado_cuenta_bancaria'] ?></td>
                <td><?= $provider['domicilio_completo'] ?></td>
                <td><?= $provider['telefono'] ?></td>
                <td><?= $provider['correo_electronico'] ?></td>
            </tr>
        <?php endforeach;
    } else {
        echo "<tr><td colspan='11'>No se encontraron proveedores.</td></tr>";
    }
    ?>
</table>

<h3>Lista de Vehículos</h3>
<a href="vehicle_form.php">
    <button>Dar de Alta un Vehículo</button>
</a>
<table>
    <tr>
        <th></th>
        <th>ID</th>
        <th>Matrícula</th>
        <th>Color</th>
        <th>Daños</th>
        <th>ID Modelo</th>
        <th>Tipo de Carburante</th>
        <th>Fecha de Matriculación</th>
        <th>Kilómetros</th>
        <th>ID Marca</th>
        <th>Descripción</th>
        <th>IVA</th>
        <th>Número de Bastidor</th>
        <th>Tipo de Cambio</th>
        <th>Precio de Venta</th>
        <th>Precio de Compra</th>
        <th>ID Comanda</th>
    </tr>
    <?php
    if (!empty($vehicles)) {
        foreach ($vehicles as $vehicle) : ?>
            <tr>
                <td>
                    <form action="index.php" method="post">
                        <input type="hidden" name="vehicleId" value="<?php echo $vehicle['id']; ?>">
                        <button type="submit" name="deleteVehicle" onclick="return confirm('¿Estás seguro de que deseas eliminar este vehículo?')">Eliminar</button>
                    </form>
                </td>
                <td><?= $vehicle['id'] ?></td>
                <td><?= $vehicle['matricula'] ?></td>
                <td><?= $vehicle['color'] ?></td>
                <td><?= $vehicle['danos'] ?></td>
                <td><?= $vehicle['id_modelo'] ?></td>
                <td><?= $vehicle['tipo_carburante'] ?></td>
                <td><?= $vehicle['fecha_matriculacion'] ?></td>
                <td><?= $vehicle['kilometros'] ?></td>
                <td><?= $vehicle['id_marca'] ?></td>
                <td><?= $vehicle['descripcion'] ?></td>
                <td><?= $vehicle['iva'] ?></td>
                <td><?= $vehicle['num_bastidor'] ?></td>
                <td><?= $vehicle['tipo_cambio'] ?></td>
                <td><?= $vehicle['precio_venta'] ?></td>
                <td><?= $vehicle['precio_compra'] ?></td>
                <td><?= $vehicle['id_comanda'] ?></td>
            </tr>
        <?php endforeach;
    } else {
        echo "<tr><td colspan='16'>No se encontraron vehículos.</td></tr>";
    }
    ?>
</table>
</body>
</html>