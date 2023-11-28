<?php
require_once('../classesPhP/Factura.php');
require_once '../classesPhP/config-base-dades.php';

try {
    $pdo = obtenerConexionPDO();
}
catch (PDOException $e) {
    die($e-> getMessage ());
}

$price = $_POST['price'] ?? '';
$facDate = $_POST['facDate'] ?? '';
$clienteId = $_POST['cliente'] ?? 0;
$comandaId = $_POST['comanda'] ?? 0;

$errors = [];

if (empty($price)) {
    $errors[] = "El camp 'Preu' és obligatori.";
}

if (empty($facDate)) {
    $errors[] = "El camp 'Data de la factura' és obligatori.";
}

if (empty($clienteId)) {
    $errors[] = "El camp 'Codi de Client' és obligatori.";
}

if (empty($comandaId)) {
    $errors[] = "El camp 'Codi de comanda' és obligatori.";
}

if (empty($errors)) {
    try {
        $factura = new Factura();
        $factura->setPreu($price);
        $factura->setData($facDate);
        $factura->setClient($clienteId);
        $factura->setComanda($comandaId);

        $stmt = $pdo->prepare("INSERT INTO factura (precio, fecha, dni_usuario, id_comanda) VALUES (?, ?, ?, ?)");
        $stmt->execute([ $factura->getPreu(), $factura->getDataAsString(), $factura->getClient(), $factura->getComanda()]);

        echo "Factura insertada con éxito.";
    }
    catch (Exception $e) {
        $errors[] = "Error al insertar la factura en la base de datos: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Factures</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<h1>Información Factura</h1>

<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php elseif (isset($factura)): ?>

    <table>
        <thead>
        <tr>
            <td scope="row">Preu</td>
            <td>Data de la factura</td>
            <td>Codi de Client</td>
            <td>Codi de comanda</td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?= $factura->getPreu(); ?></td>
            <td><?= $factura->getDataAsString(); ?></td>
            <td><?= $factura->getClient(); ?></td>
            <td><?= $factura->getComanda(); ?></td>
        </tr>
        </tbody>
    </table>
<?php endif; ?>
</body>
</html>
