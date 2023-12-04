<?php
require 'classes/Client.php';
require 'classes/ProfessionalClient.php';
require 'classes/Validation.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $address = $_POST["address"];
    $businessName = $_POST["businessName"];
    $dni = $_POST["dni"];
    $phone = $_POST["phone"];
    $targetNum = $_POST["targetNum"];
    $type = $_POST["type"];

    $lopd = $_POST["lopd"];
    $cif = $_POST["cif"];
    $managerNif = $_POST["managerNif"];
    $constitutionWriting = $_POST["constitutionWriting"];
    $subscription = $_POST["subscription"];

    $passwd = $_POST["passwd"];

    $professionalClient = new ProfessionalClient(1, $name, $lastname, $email, $username, $address, $businessName, $dni, $phone, $targetNum, $type, $passwd, $lopd, $cif, $managerNif, $constitutionWriting, $subscription);
    $validator = new Validation();

    try {
        $errors = $validator->validateAll($professionalClient);
    } catch (Exception $e) {
        $error = $e->getMessage();
    }

    if (empty($errors)) {
        try {
            $pdo = new PDO('mysql:host=mysql-server; dbname=db_project_team1', 'root', 'secret');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }

        $newClient = "INSERT INTO client (name, last_name, email, user_name, address, business_name, dni, phone, target_num, type_user, passwd) 
            VALUES (:name, :last_name, :email, :user_name, :address, :business_name, :dni, :phone, :targetNum, :type, :passwd)";

        $x = True;

        $newProfessional = "INSERT INTO professional (id, document_LOPD, CIF, manager_nif, constitution_writing, subscription) 
            VALUES (:id, :document_LOPD, :CIF, :manager_nif, :constitution_writing, :subscription)";

        $stmtClient = $pdo->prepare($newClient);
        $stmtClient->bindParam(':name', $name);
        $stmtClient->bindParam(':last_name', $lastname);
        $stmtClient->bindParam(':email', $email);
        $stmtClient->bindParam(':user_name', $username);
        $stmtClient->bindParam(':address', $address);
        $stmtClient->bindParam(':business_name', $businessName);
        $stmtClient->bindParam(':dni', $dni);
        $stmtClient->bindParam(':phone', $phone);
        $stmtClient->bindParam(':targetNum', $targetNum);
        $stmtClient->bindParam(':type', $type);
        $stmtClient->bindParam(':passwd', $passwd);

        try {
            $stmtClient->execute();
        } catch (PDOException $e) {
            echo "Error al crear el cliente: " . $e->getMessage();
        }

        $id = $pdo->lastInsertId();

        $deleteProfessional = $pdo->prepare($newProfessional);
        $deleteProfessional->bindParam(':id', $id);
        $deleteProfessional->bindParam(':document_LOPD', $lopd);
        $deleteProfessional->bindParam(':CIF', $cif);
        $deleteProfessional->bindParam(':manager_nif', $managerNif);
        $deleteProfessional->bindParam(':constitution_writing', $constitutionWriting);
        $deleteProfessional->bindParam(':subscription', $x);

        try {
            $deleteProfessional->execute();
        } catch (PDOException $e) {
            echo "Error al crear el cliente profesional: " . $e->getMessage();
        } ?>

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
                    font-size: 12px;
                }

                td {
                    padding: 0px 10px 0px 10px;
                }

                .home {
                    margin: 20px;
                    padding: 10px;
                    background-color: #e7d381ff;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    text-decoration: none;
                }

                .home:hover {
                    background-color: #aa8e31ff;
                }
            </style>
        </head>
        <body>
        <h1>Cliente creado correctamente</h1>
        <div>
            <table>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Username</th>
                    <th>Domicilio</th>
                    <th>BusinessName</th>
                    <th>NIF</th>
                    <th>Phone</th>
                    <th>Target Number</th>
                    <th>LOPD</th>
                    <th>CIF</th>
                    <th>Manager NIF</th>
                    <th>Constitucion Writing</th>
                    <th>Subscription</th>
                    <th>passwd</th>
                </tr>
                <tr>
                    <td><?= $name ?></td>
                    <td><?= $lastname ?></td>
                    <td><?= $email ?></td>
                    <td><?= $username ?></td>
                    <td><?= $address ?></td>
                    <td><?= $businessName ?></td>
                    <td><?= $dni ?></td>
                    <td><?= $phone ?></td>
                    <td><?= $targetNum ?></td>
                    <td><?= $lopd ?></td>
                    <td><?= $cif ?></td>
                    <td><?= $managerNif ?></td>
                    <td><?= $constitutionWriting ?></td>
                    <td><?= $subscription ?></td>
                    <td><?= $passwd ?></td>
                </tr>
            </table>
        </div>
        <div>
            <a class="home" href="home.php">Ver lista de clientes</a>
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
?>