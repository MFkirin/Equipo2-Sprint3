<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
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
    $passwd = $_POST["passwd"];
    $cif = $_POST["cif"];
    $managerNif = $_POST["managerNif"];

    try {
        $pdo = new PDO('mysql:host=mysql-server; dbname=db_project_team1', 'root', 'secret');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $queryClient = "UPDATE client SET
            name = :name,
            last_name = :lastname,
            email = :email,
            user_name = :username,
            address = :address,
            business_name = :businessName,
            dni = :dni,
            phone = :phone,
            target_num = :targetNum,
            type_user = :type,
            passwd = :passwd
            WHERE id = :id";

        $stmtClient = $pdo->prepare($queryClient);
        $stmtClient->bindParam(':id', $id);
        $stmtClient->bindParam(':name', $name);
        $stmtClient->bindParam(':lastname', $lastname);
        $stmtClient->bindParam(':email', $email);
        $stmtClient->bindParam(':username', $username);
        $stmtClient->bindParam(':address', $address);
        $stmtClient->bindParam(':businessName', $businessName);
        $stmtClient->bindParam(':dni', $dni);
        $stmtClient->bindParam(':phone', $phone);
        $stmtClient->bindParam(':targetNum', $targetNum);
        $stmtClient->bindParam(':type', $type);
        $stmtClient->bindParam(':passwd', $passwd);

        $stmtClient->execute();

        $queryProfessional = "SELECT document_LOPD, constitution_writing, subscription FROM professional WHERE id = :id";
        $stmtProfessional = $pdo->prepare($queryProfessional);
        $stmtProfessional->bindParam(':id', $id);
        $stmtProfessional->execute();
        $professionalResult = $stmtProfessional->fetch(PDO::FETCH_ASSOC);

        $queryUpdateProfessional = "UPDATE professional SET
            document_LOPD = :document_LOPD,
            CIF = :cif,
            manager_nif = :managerNif,
            constitution_writing = :constitutionWriting,
            subscription = :subscription
            WHERE id = :id";

        $stmtUpdateProfessional = $pdo->prepare($queryUpdateProfessional);
        $stmtUpdateProfessional->bindParam(':id', $id);
        $stmtUpdateProfessional->bindParam(':document_LOPD', $professionalResult['document_LOPD']);
        $stmtUpdateProfessional->bindParam(':cif', $cif);
        $stmtUpdateProfessional->bindParam(':managerNif', $managerNif);
        $stmtUpdateProfessional->bindParam(':constitutionWriting', $professionalResult['constitution_writing']);
        $stmtUpdateProfessional->bindParam(':subscription', $professionalResult['subscription']);

        $stmtUpdateProfessional->execute();

        header("Location: home.php");
    } catch (PDOException $e) {
        die("Error al actualizar la información: " . $e->getMessage());
    }
}
?>
