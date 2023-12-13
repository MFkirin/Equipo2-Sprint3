<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Client</title>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            ini_set('display_errors', 'on');
            error_reporting(E_ALL);

            require '../classesPhP/Client.php';
            $client = new Client(); 
        ?>

        <h1>CLIENT</h1>
        <div>
            <ul>
                <li><a href="index.php">Inici</a></li>
                <li><a href="client-generar.php">Client</a></li>
                <li><a href="cataleg.php">Cataleg</a></li>
            </ul>
        </div>
        
        <p><?php echo "<strong>Nombre:</strong> " . $client->generarNom(); ?></p>
        <p><?php echo "<strong>Usuario:</strong> " . $client->generarUsuari(); ?></p>
        <p><?php echo "<strong>Email:</strong> " . $client->generarEmail(); ?></p>
        <p><?php echo "<strong>DNI:</strong> " . $client->getDNI(); ?></p>
        <p><?php echo "<strong>Direcció:</strong> " . $client->generarDireccio(); ?></p>
        <p><?php echo "<strong>Targeta:</strong> " . $client->generarTargeta(); ?></p>
            <div>
                <p><a href="comanda-generar.php">Comanda</p>
                <p><a href="factura-generar.php">Factura</a></p>
            </div>
        </div>
    </body>
</html>