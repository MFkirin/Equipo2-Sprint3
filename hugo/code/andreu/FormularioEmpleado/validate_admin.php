<?php
session_start();
require_once 'Empleado.php';

// Establecer la conexión a la base de datos
$host = 'mysql-server';
$dbname = 'db_project_team1';
$username = 'root';
$password = 'secret';

$resultados = array();
$inserted = false; // Inicializar $inserted

try {
    // Crear una instancia de PDO para la conexión a la base de datos
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['name'];
    $apellido = $_POST['lastName'];
    $tipo = $_POST['type'];
    $contrasena = $_POST['password'];

    // Realizar validaciones de campos aquí (si es necesario)
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $resultados = array();
        $token = $_POST["csrf_token"];

        // Validar si se recibió una solicitud de eliminación
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['id_eliminar'])) {
            $idEmpleadoEliminar = $_POST['id_eliminar'];
            $empleadoEliminar = new Empleado($idEmpleadoEliminar, '', '', '', '');

            $eliminado = $empleadoEliminar->eliminarEmpleado($conn);

            if ($eliminado) {
                $mensaje = 'Empleado eliminado correctamente';
            } else {
                $mensaje = 'Error al eliminar el empleado';
            }
        }

        if (hash_equals($_SESSION["token"], $token)) {
            $id = $_POST['id'];
            $nombre = $_POST['name'];
            $apellido = $_POST['lastName'];
            $tipo = $_POST['type'];
            $contrasena = $_POST['password'];

            // Realiza las validaciones de los campos
            $patronNombre = "/^[A-Za-z]{1,30}$/";
            $patronPass = '/^(?=.*\d)(?=.*[A-Z])(?=.*[a-z])(?=.*[^\w\s:])(\S){8,16}$/m';

            if (preg_match($patronNombre, $nombre)) {
                $resultados['ID'] = $id;
                $resultados['Nombre'] = $nombre;
            } else {
                $resultados['Nombre'] = 'Nombre incorrecto';
            }

            if (preg_match($patronNombre, $apellido)) {
                $resultados['Apellido'] = $apellido;
            } else {
                $resultados['Apellido'] = 'Apellido incorrecto';
            }

            $resultados['Tipo'] = $tipo;

            if (preg_match($patronPass, $contrasena)) {
                $resultados['Contraseña'] = 'Contraseña válida';
            } else {
                $resultados['Contraseña'] = 'Contraseña incorrecta';
            }
        } else {
            $resultados['Token'] = 'El token no coincide';
        }
    } else {
        $resultados['Mensaje'] = 'No se recibieron datos del formulario';
    }

    // Preparar la consulta SQL para la inserción
    $sql = "INSERT INTO employee (id, name, last_name, type, passwd) VALUES (:id, :nombre, :apellido, :tipo, :contrasena)";

    // Preparar la declaración
    $stmt = $conn->prepare($sql);

    // Bind de parámetros
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':contrasena', $contrasena);

    // Ejecutar la consulta
    $stmt->execute();

    // Verificar si la inserción fue exitosa
    if ($stmt->rowCount() > 0) {
        $inserted = true;
        $mensaje = 'Usuario insertado correctamente';
    } else {
        $mensaje = 'Error al insertar usuario';
    }
} catch (PDOException $e) {
    // Manejar errores de conexión a la base de datos aquí...
    $mensaje = 'Error de conexión: ' . $e->getMessage();
}

// Mostrar resultados en la página
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Resultados del Formulario</title>
    <meta charset="utf-8">
</head>

<body>
<h2>Resultados del Formulario</h2>
<table border="1">
    <tr>
        <th>Campo</th>
        <th>Valor</th>
    </tr>
    <tr>
        <td>Mensaje</td>
        <td><?php echo $mensaje; ?></td>
    </tr>
    <?php
    if ($inserted) {
        foreach ($resultados as $campo => $valor) {
            echo "<tr><td>$campo</td><td>$valor</td></tr>";
        }
    }
    ?>
</table>
</body>

</html>