<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>
<body>
<h1>Welcome</h1>
<?php
if (isset($_GET["nom"])) {
    $nom = $_GET["nom"];
    echo "<p>Welcome, $nom!!!</p>";
} else {
    echo "<p>Error: You have to enter a name.</p>";
}
?>
</body>
</html>


