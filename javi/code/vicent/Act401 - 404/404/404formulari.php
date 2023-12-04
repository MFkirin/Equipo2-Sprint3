<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="utf-8">
    <title>Formulari Processat</title>
</head>

<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $url = $_POST["url"];

    // Validar datos
    $nameError = strlen($name) > 100 ? "Nombre demasiado largo" : "";
    $phoneError = !preg_match("/^\d{9}$/", $phone) ? "Teléfono inválido, debe tener 9 dígitos" : "";
    $emailError = !filter_var($email, FILTER_VALIDATE_EMAIL) ? "Correo electrònico no vàlido" : "";
    $urlError = !filter_var($url, FILTER_VALIDATE_URL) ? "URL indicada no vàlida" : "";

    // Mostrar errores
    if (!empty($nameError) || !empty($phoneError) || !empty($emailError) || !empty($urlError)) {
        echo "<h1>Errors en el formulari:</h1>";
        echo "<ul>";
        if (!empty($nameError)) {
            echo "<li>$nameError</li>";
        }
        if (!empty($phoneError)) {
            echo "<li>$phoneError</li>";
        }
        if (!empty($emailError)) {
            echo "<li>$emailError</li>";
        }
        if (!empty($urlError)) {
            echo "<li>$urlError</li>";
        }
        echo "</ul>";
    } else {
        // Mostrar datos en una tabla si no hay errores
        echo "<h1>Dades del Formulari</h1>";
        echo "<table border='1'>";
        echo "<tr><td><strong>Nom i Cognoms:</strong></td><td>$name</td></tr>";
        echo "<tr><td><strong>Correu electrònic:</strong></td><td>$email</td></tr>";
        echo "<tr><td><strong>Telèfon:</strong></td><td>$phone</td></tr>";
        echo "<tr><td><strong>URL de la pàgina personal:</strong></td><td>$url</td></tr>";
        echo "</table>";
    }
}
?>

</body>

</html>
