<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    $pdo = new PDO('mysql:host=mysql-server; dbname=db_project_team1', 'root', 'secret');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try {
        $queryClient = "SELECT * FROM client WHERE id = :id";
        $stmtClient = $pdo->prepare($queryClient);
        $stmtClient->bindParam(':id', $id);
        $stmtClient->execute();
        $clientResult = $stmtClient->fetch(PDO::FETCH_ASSOC);

        if (!$clientResult) {
            die("Cliente no encontrado");
        }
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }

    try {
        $queryProfessioanl = "SELECT * FROM professional WHERE id = :id";
        $stmtProfessional = $pdo->prepare($queryProfessioanl);
        $stmtProfessional->bindParam(':id', $id);
        $stmtProfessional->execute();
        $professionalResult = $stmtProfessional->fetch(PDO::FETCH_ASSOC);

        if (!$professionalResult) {
            die("Cliente no encontrado");
        }
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }

    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" href="styles/style.css">
    </head>
    <body>
    <h1>Editar Cliente</h1>
    <div>
        <div class="container">
            <form action="guardar_edicion_cliente.php" method="POST">
                <div class="form">
                    <div class="form-left">
                        <div>
                            <label for="name">Nombre:</label><br>
                            <input id="name" name="name" type="text" value="<?= $clientResult['name'] ?>">
                        </div>
                        <div>
                            <label for="lastname">Apellidos:</label><br>
                            <input id="lastname" name="lastname" type="text" value="<?= $clientResult['last_name'] ?>">
                        </div>
                        <div>
                            <label for="email">Email:</label><br>
                            <input id="email" name="email" type="text" value="<?= $clientResult['email'] ?>">
                        </div>
                        <div>
                            <label for="username">Nombre de usuario:</label><br>
                            <input id="username" name="username" type="text" value="<?= $clientResult['user_name'] ?>">
                        </div>
                        <div>
                            <label for="address">Domicilio:</label><br>
                            <input id="address" name="address" type="text" value="<?= $clientResult['address'] ?>">
                        </div>
                        <div>
                            <label for="businessName">Nombre de la empresa:</label><br>
                            <input id="businessName" name="businessName" type="text" value="<?= $clientResult['business_name'] ?>">
                        </div>
                        <div>
                            <label for="dni">DNI:</label><br>
                            <input id="dni" name="dni" type="text" value="<?= $clientResult['dni'] ?>">
                        </div>
                        <div>
                            <label for="phone">Telefono:</label><br>
                            <input id="phone" name="phone" type="tel" value="<?= $clientResult['phone'] ?>">
                        </div>
                        <div>
                            <label for="targetNum">Target Number:</label><br>
                            <input id="targetNum" name="targetNum" type="text" value="<?= $clientResult['target_num'] ?>">
                        </div>
                    </div>
                    <div class="form-right">
                        <div>
                            <label for="cif">CIF:</label><br>
                            <input id="cif" name="cif" type="text" value="<?= $professionalResult['CIF'] ?>">
                        </div>
                        <div>
                            <label for="managerNif">Manager NIF:</label><br>
                            <input id="managerNif" name="managerNif" type="text" value="<?= $professionalResult['manager_nif'] ?>">
                        </div>
                        <div>
                            <label for="subscription">Subscription:</label><br>
                            <input id="subscription" name="subscription" type="text" value="<?= $professionalResult['subscription'] ?>">
                        </div>
                        <div>
                            <label for="lopd">LOPD:</label><br>
                            <input id="lopd" name="lopd" type="file" value="<?= $professionalResult['document_LOPD'] ?>">
                        </div>
                        <div>
                            <label for="constitutionWriting">Constitution Writing:</label><br>
                            <input id="constitutionWriting" name="constitutionWriting" type="file" value="<?= $professionalResult['constitution_writing'] ?>">
                        </div>
                        <div>
                            <label for="passwd">Password:</label><br>
                            <input id="passwd" name="passwd" type="text" value="<?= $clientResult['passwd'] ?>">
                        </div>
                    </div>
                    <input style="display:none" id="type" name="type" value="Professional">
                    <input style="display:none" id="id" name="id" value="<?= $clientResult['id'] ?>">
                    <div id="button">
                        <button type="submit">Modificar informacion</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </body>
    </html>
    <?php
}
?>
