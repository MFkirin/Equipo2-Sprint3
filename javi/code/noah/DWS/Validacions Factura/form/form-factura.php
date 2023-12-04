<?php
require_once '../classesPhP/Comanda.php';
require_once '../classesPhP/Client.php';
require_once '../classesPhP/config-base-dades.php';

$pdo = obtenerConexionPDO();

// Creacion dels arrays per a la aleatorietat
$comandes = array();
$clients = array();

// Preparar la meua consulta SQL per a obtindre informació de la meua base de dades
$stmt = $pdo->prepare("SELECT * FROM usuario");

// Es per a fer que la consulta guardada en la variable stmt s'execute
$stmt->execute();

// La variable usuaris emmagatzemarà tota la informació que retorne la consulta com un "arreglo de files" -> Preguntar a classe
$usuaris = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Segona consulta
$stmt2 = $pdo->prepare("SELECT * FROM comanda");
$stmt2->execute();
$comandes = $stmt2->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Factures</title>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>
<h1>Validar una factura</h1>
<form method="post" action="form-factura-pagina-validacio.php" novalidate>
    <div>
        <label for="price">Preu</label>
        <input type="text" id="price" name="price" required pattern="^\d+(\.\d{1,2})?$"
               title="Ingrese un número válido (puede incluir hasta 2 decimales)">
    </div>
    <div>
        <label for="facDate">Data de la Factura</label>
        <input type="date" id="facDate" name="facDate" required>
    </div>
    <div>
        <label for="cliente">Cliente:</label>
        <select id="cliente" name="cliente" required>
            <option selected disabled="disabled" hidden="true">seleccione el client</option>
            <?php foreach ($usuaris as $usuari) : ?>
                <option value="<?= $usuari['DNI']; ?>"><?= $usuari['nombre'] ?></option>

            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="comanda">Comanda:</label>
        <select id="comanda" name="comanda" required>
            <option selected disabled="disabled" hidden="true">selecciona la comanda</option>
            <?php foreach ($comandes as $comanda) : ?>
                <option value="<?= $comanda['id']; ?>"><?= $comanda['matricula_v'] ?></option>    <!-- Açi hi ha algun error, no se quin -->

            <?php endforeach; ?>
        </select>
    </div>

    <input type="submit" value="Validar Factura">
</form>
<div class="link">
    <a href="factura-llista-factures.php">Pàgina modificació de factures</a>
</div>
</body>
</html>
