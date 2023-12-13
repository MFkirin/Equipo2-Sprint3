<?php
session_start();
require_once 'Empleado.php';

$host = 'mysql-server';
$dbname = 'db_project_team1';
$username = 'root';
$password = 'secret';

$resultados = array();
$mensaje = ''; // Inicializar $mensaje

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $token = $_POST["csrf_token"];
    $id = $_POST['id'];
    $nombre = $_POST['name'];
    $apellido = $_POST['lastName'];
    $tipo = $_POST['type'];
    $contrasena = $_POST['password'];

    // Realizar las validaciones de campos
    $patronNombre = "/^[A-Za-z]{1,30}$/";
    $patronPass = '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\s:])(\S){8,16}$/m';

    $errores = array();

    if (!preg_match($patronNombre, $nombre)) {
        $errores[] = 'Nombre incorrecto';
        $errores[] = 'No se ha podido crear el empleado';
    }

    if (!preg_match($patronNombre, $apellido)) {
        $errores[] = 'Apellido incorrecto';
        $errores[] = 'No se ha podido crear el empleado';
    }

    if (!preg_match($patronPass, $contrasena)) {
        $errores[] = 'Contraseña incorrecta';
        $errores[] = 'No se ha podido crear el empleado';
    }

    if (empty($errores) && hash_equals($_SESSION["token"], $token)) {
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO employee (id, name, last_name, type, passwd) VALUES (:id, :nombre, :apellido, :tipo, :contrasena)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':apellido', $apellido);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':contrasena', $contrasena);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $mensaje = 'Usuario insertado correctamente';
            } else {
                $mensaje = 'Error al insertar usuario';
            }
        } catch (PDOException $e) {
            $mensaje = 'Error de conexión: ' . $e->getMessage();
        }
    } else {
        $mensaje = implode(', ', $errores);
    }
} else {
    $mensaje = 'No se recibieron datos del formulario';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <title>Resultados del Formulario</title>
    <meta charset="utf-8">
</head>

<body>
<h2>Resultados del Formulario</h2>
<p><?php echo $mensaje; ?></p>
<div>
    <form action="form_create_employee.php" method="post">
        <input type="submit" value="Volver atrás">
    </form>
    <form action="read_employee.php" method="post">
        <input type="submit" value="Mostrar todos los empleados">
    </form>
</div>
</body>

</html>