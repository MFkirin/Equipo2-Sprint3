<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulari</title>
</head>
<body>
<?php
    $nom = $_POST["nombre"];
    $correu = $_POST["correu"];
    $telefon = $_POST["telefono"];
    $url = $_POST["url"];

    echo "<h2>Datos Introducidos:</h2>";
    echo "<table>";
    echo "<tr><th>Nombre y Apellido</th><th>Correo</th><th>Teléfono</th><th>URL</th></tr>";
    echo "<tr><td>$nom</td><td>$correu</td><td>$telefon</td><td>$url</td></tr>";
    echo "</table>";
?>
</body>
</html>

