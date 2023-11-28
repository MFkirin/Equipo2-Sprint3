<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Factura</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
        /**
        * Aquest document genera una factura aleatoria 
        * amb les dades generades de la classe Factura
        * 
        */
            ini_set("display_errors", "on");
            require '../classesPhP/Factura.php';
            $factura = new Factura();

            $preu = $factura->generarPreuAleatori();
            $producte = $factura->generarProducteAleatori();
            $cantitat = $factura->generarQuantitatAleatoria();
            $numFactura = $factura->generarNumeroFacturaAleatori();
            $total = $factura->calcularTotal($preu, $cantitat);
            $data = $factura->generarDataActual();
            $client = $factura->obtenirProveidorAleatori();
            $remitent = $factura->obtenirClientAleatori();
        ?>

        <h1>FACTURA</h1>
        <div>
            <li><a href="index.php">Inici</a></li>
            <li><a href="client-generar.php">Client</a></li>
            <li><a href="cataleg.php">Catàleg</a></li>
        </div>

        <p><strong>Nº Factura: </strong><?php echo $numFactura ?></p>

        <p><strong>Client: </strong><?php echo $client ?></p>

        <p><strong>Remitent: </strong><?php echo $remitent ?></p>

        <p><strong>Data: </strong> <?php echo $data ?></p>

        <p><strong>Producte: </strong><?php echo $producte ?></p>

        <p><strong>Cantitat: </strong><?php echo $cantitat ?></p>

        <p><strong>Preu: </strong> <?php echo $preu ?></p>

        <p><strong>Preu Total: </strong> <?php echo number_format($total, 2, ',', '.') . " €" ?> </p>
    </body>
</html>
