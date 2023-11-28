<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Comanda</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            require '../classesPhP/Comanda.php';
            $comanda = new Comanda();

            $vehicles = $comanda->generarVehicleAleatori();
            $codiComanda = $comanda->generarCodiComandaAleatori();
            $estat = $comanda->generarEstatVehicleAleatori();
        ?>
        <h1>Comanda</h1>
        <div>
            <li><a href="index.php">Inici</a></li>
            <li><a href="client-generar.php">Client</a></li>
            <li><a href="cataleg.php">Catàleg</a></li>
        </div>
        <p><strong>Codi comanda: </strong><?php echo $codiComanda ?></p>
        <p><strong>Vehicle: </strong><?php echo $vehicles ?></p>
        <p><strong>Estat: </strong><?php echo $estat ?></p>
    </body>
</html>