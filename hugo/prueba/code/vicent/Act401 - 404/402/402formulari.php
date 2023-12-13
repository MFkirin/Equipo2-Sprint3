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
?>

    <h1>Dades del Formulari</h1>
    <table border="1">
        <tr>
            <td><strong>Nom i Cognoms:</strong></td>
            <td><?= $name ?></td>
        </tr>
        <tr>
            <td><strong>Correu electrònic:</strong></td>
            <td><?= $email ?></td>
        </tr>
        <tr>
            <td><strong>Telèfon:</strong></td>
            <td><?= $phone ?></td>
        </tr>
        <tr>
            <td><strong>URL de la pàgina personal:</strong></td>
            <td><?= $url ?></td>
        </tr>
    </table>

<?php
}
?>

</body>

</html>
