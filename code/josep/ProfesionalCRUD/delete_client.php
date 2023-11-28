<?php
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

    try {
        $pdo = new PDO('mysql:host=mysql-server; dbname=db_project_team1', 'root', 'secret');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $deleteProfessional = "DELETE FROM professional WHERE id = :id";
        $stmtProfessional = $pdo->prepare($deleteProfessional);
        $stmtProfessional->bindParam(':id', $id, PDO::PARAM_INT);

        $deleteClient = "DELETE FROM client WHERE id = :id";
        $stmtClient = $pdo->prepare($deleteClient);
        $stmtClient->bindParam(':id', $id, PDO::PARAM_INT);

        $pdo->beginTransaction();

        if ($stmtProfessional->execute() && $stmtClient->execute()) {
            $pdo->commit();
            header("Location: home.php");
            exit;
        } else {
            $pdo->rollBack();
            echo "Error al eliminar el cliente.";
        }
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
} else {
    echo "Error: No se proporcionó un ID de cliente válido.";
}

?>