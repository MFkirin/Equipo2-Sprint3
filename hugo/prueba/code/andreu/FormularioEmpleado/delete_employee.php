<?php
try {
    // Establecer la conexión a la base de datos
    $host = 'mysql-server';
    $dbname = 'db_project_team1';
    $username = 'root';
    $password = 'secret';

    // Crear una instancia de PDO para la conexión a la base de datos
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener la id del empleado a eliminar del formulario
    $employeeId = $_POST["employee_id"];

    // Preparar la consulta SQL
    $sql = "DELETE FROM employee WHERE id = :id";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);

    // Bind de parámetro
    $stmt->bindParam(':id', $employeeId);

    // Ejecutar la consulta
    $stmt->execute();

    // Verificar si el empleado fue eliminado correctamente
    if ($stmt->rowCount() > 0) {
        echo "Empleado eliminado correctamente.";
    } else {
        echo "No se encontró ningún empleado con esa ID.";
    }
} catch (PDOException $e) {
    error_log('Error para eliminar el empleado: ' . $e->getMessage());
    echo "Error al eliminar el empleado: " . $e->getMessage();
}
?>
<html>
<head>
    <title>Delete employee</title>
</head>
<body>
<div>
    <form action="read_employee.php" method="post">
        <input type="submit" value="Volver atrás">
    </form>
</div>
</body>
</html>
