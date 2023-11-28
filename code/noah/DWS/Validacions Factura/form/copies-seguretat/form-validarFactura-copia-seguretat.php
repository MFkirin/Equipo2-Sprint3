<?php
require_once 'Comanda.php';
require_once 'Client.php';

// Creacion dels arrays per a la aleatorietat
$comandes = array();
$clients = array();

// Conexió a la base de dades
$host = 'mysql-server';
$dbname = 'db_equip3';
$user = 'root';
$pass = 'secret';

// Excepció per verificar que estem conectant-mos a la base de dades
try {
    $pdo = new PDO  ("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

    $pdo->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    die($e-> getMessage ());

}

// Preparar la meua consulta SQL per a obtindre informació de la meua base de dades

$stmt = $pdo->prepare("SELECT * FROM usuario");

// Es per a fer que la consulta guardada en la variable stmt s'execute
$stmt->execute();

// La variable usuaris emmagatzemarà tota la informació que retorne la consulta com un "arreglo de files" -> Preguntar a classe
$usuaris = $stmt->fetchAll(PDO::FETCH_ASSOC);



for ($i = 1; $i < 4; $i++) {
    $client = new Client();
    $client->setId($i);
    $client->setName($client->generarNom());
    $clients[] = $client;

    $comanda = new Comanda();
    $comanda->setCodiDeComanda($i);
    $comanda->setVehicle($comanda->generarVehicleAleatori());
    $comanda->setEstatVehicle($comanda->generarEstatVehicleAleatori());
    $comandes[] = $comanda;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Factures</title>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
<h1>Validar una factura</h1>
<form method="post" action="paginaValidacionFactura.php" novalidate>
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
        <label for="codigo_factura">Codi de factura</label>
        <input type="text" id="codigo_factura" name="codigo_factura" required>
    </div>
    <div>
        <label for="cliente">Cliente:</label>
        <select id="cliente" name="cliente" required>
            <option selected disabled="disabled" hidden="true">seleccione el client</option>
            <?php foreach ($clients as $index => $client) : ?>
                <option value="<?= $client->getId(); ?>"><?= $client->getName() ?></option>

            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label for="comanda">Comanda:</label>
        <select id="comanda" name="comanda" required>
            <option selected disabled="disabled" hidden="true">selecciona la comanda</option>
            <?php foreach ($comandes as $index => $comanda) : ?>
                <option value="<?= $comanda->getCodiDeComanda(); ?>"><?= $comanda->getVehicle(); ?></option>

            <?php endforeach; ?>
        </select>
    </div>

    <input type="submit" value="Validar Factura">
</form>
</body>
</html>
