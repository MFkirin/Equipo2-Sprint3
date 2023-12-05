<?php
try {
    $pdo = new PDO('mysql:host=mysql-server; dbname=db_project_team1', 'root', 'secret');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM client WHERE type_user = 'Professional'";
    $result = $pdo->query($sql);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clientes Profesionales</title>
    <link rel="stylesheet" href="styles/style2.css">
</head>
<body>

<h1>Clientes profesionales</h1>

<div class="container">
    <table>
        <tr>
            <th>Name</th>
            <th>Lastname</th>
            <th>Username</th>
            <th>Actions</th>
        </tr>

        <?php
        foreach ($result as $row) { ?>
            <tr>
                <td class='info'> <?= $row['name'] ?> </td>
                <td class='info'> <?= $row['last_name'] ?> </td>
                <td class='info'> <?= $row['user_name'] ?> </td>
                <td>
                    <div class='containerButtons'>
                        <div>
                            <a href="modify_client.php?id=<?= $row['id'] ?>"  class='modify'>Modificar</a>
                        </div>
                        <div>
                            <a href="delete_client.php?id=<?= $row['id'] ?>" class='delete'>Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>

</div>

<div>
    <a class="create" href="form.php">Crear nuevo cliente profesional</a>
</div>

</body>
</html>