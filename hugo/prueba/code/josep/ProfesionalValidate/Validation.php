<?php
require 'classes/ProfessionalValidation.php';
require 'classes/ProfessionalClient.php';

$name = $_POST["name"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$username = $_POST["username"];
$nif = $_POST["nif"];
$businessName = $_POST["businessName"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$cif = $_POST["cif"];
$passwd = $_POST["passwd"];
$rpasswd = $_POST["rpasswd"];


$professionalClient = new ProfessionalClient(1, $name, $lastname, $email, $username, $nif, $businessName, $phone, $address, $cif, $passwd, $rpasswd);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST)!=$_SERVER['HTTP_HOST']) {

    $validator = new ProfessionalValidation();

    try {
        $errors = $validator->validateAll($professionalClient);
    } catch (Exception $e) {
        $error = $e->getMessage();
    }

    if (empty($errors)) { ?>

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
                    <th>Correo</th>
                    <th>Username</th>
                    <th>NIF</th>
                    <th>Business Name</th>
                    <th>Telefono</th>
                    <th>Direccion</th>
                    <th>CIF</th>
                    <th>Password</th>
                    <th>RPassword</th>
                </tr>
                <tr>
                    <td><?= $name ?></td>
                    <td><?= $lastname ?></td>
                    <td><?= $email ?></td>
                    <td><?= $username ?></td>
                    <td><?= $nif ?></td>
                    <td><?= $businessName ?></td>
                    <td><?= $phone ?></td>
                    <td><?= $address ?></td>
                    <td><?= $cif ?></td>
                    <td><?= $passwd ?></td>
                    <td><?= $rpasswd ?></td>
                </tr>
            </table>
        </div>
        </body>
        </html>

        <?php
    } else {
        $errors = $validator->validateAll($professionalClient);
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
        <?php
    }
}
}
?>