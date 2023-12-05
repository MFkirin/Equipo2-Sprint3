<?php
require 'Validator.php';

$name = $_POST["name"];
$apellidos = $_POST["lastname"];
$businessName = $_POST["businessName"];
$domicilio = $_POST["domicilio"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$nif = $_POST["nif"];
$cif = $_POST["cif"];
$passwd = $_POST["passwd"];
$rpasswd = $_POST["rpasswd"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validator = new Validator($name, $apellidos, $businessName, $domicilio, $email, $phone, $nif, $cif, $passwd, $rpasswd);

    if ($validator->validate()):
?>

<!DOCTYPE html>
<html>
<head>
<style>
    body {
        margin: 0;
        background-color: #e7e7e9ff;
        font-family: Arial, sans-serif;
    }

    h1 {
        text-align: center;
        padding: 20px;
    }

    div {
        display: flex;
        justify-content: center;
    }it

    table {
        border-radius: 10px;
        padding: 20px;
        align-items: center;
        text-align: center;
        background-color: white;
    }

    td {
        padding: 0px 10px 0px 10px;
    }
</style>
</head>
<body>
<h1>Registro completado correctamente</h1>
<div>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Empresa</th>
            <th>Domicilio</th>
            <th>Email</th>
            <th>Phone</th>
            <th>NIF</th>
            <th>CIF</th>
            <th>Password</th>
            <th>RPassword</th>
        </tr>
        <tr>
            <td><?= $name ?></td>
            <td><?= $apellidos ?></td>
            <td><?= $businessName ?></td>
            <td><?= $domicilio ?></td>
            <td><?= $email ?></td>
            <td><?= $phone ?></td>
            <td><?= $nif ?></td>
            <td><?= $cif ?></td>
            <td><?= $passwd ?></td>
            <td><?= $rpasswd ?></td>
        </tr>
    </table>
</div>
</body>
</html>

<?php
else:
    $errors = $validator->getErrors();
?>
<!DOCTYPE html>
<html>
<head>
<style>
    body {
        margin: 0;
        background-color: #e7e7e9ff;
        font-family: Arial, sans-serif;
    }

    h1 {
        text-align: center;
        padding: 20px;
    }

    div {
        display: flex;
        justify-content: center;
    }

    .errors {
        padding: 50px;
        color: red;
        text-align: center;
    }
</style>
</head>
<body>
<div class="errors">
    <?php foreach ($errors as $error): ?>
        <?= $error ?><br>
    <?php endforeach; ?>
</div>
</body>
</html>
<?php endif;
}
?>
