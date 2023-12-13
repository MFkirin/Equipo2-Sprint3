2
<?php
global $token;
?>

<html lang="en">

<head>
    <title>Administradores</title>
</head>

<body>
<h1>Administradores</h1>
<div>
    <table>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Tipo</th>
            <th>Contraseña</th>
        </tr>
        <?php
        try {
            $pdo = new PDO("mysql:host=mysql-server; dbname=db_project_team1", "root", "secret");
            $stmt = $pdo->query("SELECT * FROM employee");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['last_name'] . "</td>";
                echo "<td>" . $row['type'] . "</td>";
                echo "<td>" . $row['passwd'] . "</td>";
                echo "</tr>";
            }
        } catch (PDOException $e) {
            echo "Error " . $e->getMessage();
        }
        ?>
    </table>
    <div>
        <form action="form_create_employee.php" method="post">
            <input type="submit" value="Agregar Empleado">
        </form>
        <form action="delete_employee.php" method="post">
            <label for="employee_id">ID del Empleado:</label>
            <input type="text" name="employee_id" id="employee_id" required>
            <input type="submit" value="Eliminar Empleado">
        </form>
    </div>
</div>
</body>

</html>
