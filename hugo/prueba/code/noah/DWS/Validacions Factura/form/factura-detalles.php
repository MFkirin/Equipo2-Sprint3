<?php
require '../classesPhP/Factura.php';
require '../classesPhP/FacturaCRUD.php';
require_once '../classesPhP/config-base-dades.php';

class BaseDades1Exception extends Exception {
    public function __construct($message = "Error en la base de dades", $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

try {
    $pdo = obtenerConexionPDO();
} 
catch (BaseDades1Exception $e) {
    echo "No s'ha pogut accedir a la base de dades: " . $e->getMessage();
} 
catch (Exception $e) {
    echo "Excepció genèrica capturada: " . $e->getMessage();
}

$facturaCRUD = new FacturaCRUD($pdo);

if (isset($_GET['id'])) {
    $facturaId = $_GET['id'];
    $factura = $facturaCRUD->getFacturaById($facturaId);

    if (isset($_POST['updateFactura'])) {
        // Procesar el formulario de actualización
        $factura->setPreu($_POST['precio']);
        $factura->setData($_POST['fecha']);
        $factura->setClient($_POST['dni_usuario']);
        $factura->setComanda($_POST['id_comanda']);

        if ($facturaCRUD->updateFactura($facturaId, $factura)) {
            echo "Factura actualizada con éxito.";
        } else {
            echo "Error al actualizar la factura.";
        }
    }
} else {
    echo 'xd';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detalle de Factura</title>
</head>
<body>
<h1>Detalle de Factura</h1>

<?php if (isset($factura)): ?>
    <ul>
        <li>Factura ID: <?= $factura->getNumFactura() ?></li>
        <li>Precio: <?= $factura->getPreu() ?></li>
        <li>Fecha: <?= $factura->getDataAsString() ?></li>
        <li>DNI Usuario: <?= $factura->getClient() ?></li>
        <li>ID Comanda: <?= $factura->getComanda() ?></li>
    </ul>

    <h2>Editar Factura</h2>
    <form method="POST">
        <input type="text" name="precio" placeholder="Nuevo Precio" value="<?= $factura->getPreu() ?>" required>
        <input type="date" name="fecha" value="<?= $factura->getDataAsString() ?>" required>
        <input type="text" name="dni_usuario" placeholder="Nuevo DNI Usuario" value="<?= $factura->getClient() ?>" required>
        <input type="text" name="id_comanda" placeholder="Nuevo ID Comanda" value="<?= $factura->getComanda() ?>" required>
        <button type="submit" name="updateFactura">Actualizar Factura</button>
    </form>
<?php else: ?>
    <p>Factura no encontrada.</p>
<?php endif; ?>

</body>
</html>
