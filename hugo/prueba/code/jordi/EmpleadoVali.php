

<?php
session_start();
include './ClasesPhP/Empleado.php';
//include 'FormRegistAdmin.php';
$ID = rand(0,1000);
$nombre = $_POST['nombre'];
$apellido = $_POST['Apellido'];
$tipo = "Empleado";
$email = $_POST['correo'];
$contrasena = $_POST['Contraseña'];
$confirmarCon = $_POST["confirmarContraseña"];
$tipo_usuario = "administrador";
$patronNombre="/[A-Za-z]{1,30}/";
$patronEmail=" /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/ ";
$patronPass="/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$^&*()_-]).{8,18}$/";

//$empleadoValidar=new Empleado($ID,$nombre,$apellido,$tipo,$email,$constrasena);
//echo $empleadoValidar->ID;

$host = 'mysql-server';
$dbname = 'db_project_team1';
$username = 'root';
$passwordBD = 'secret';

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $passwordBD);
  echo "Connected to $dbname at $host successfully.<br>";
} catch (PDOException $pe) {
  die("Could not connect to the database $dbname :" . $pe->getMessage());
}

$sql = "INSERT INTO employee ( name, last_name, type, passwd)
        VALUES ( :name,:last_name,:type,:passwd)";
        $admin=$conn->prepare($sql);

       
        $admin->bindParam(':name', $nombre);
        $admin->bindParam(':last_name', $apellido);
        $admin->bindParam(':type', $tipo_usuario);
        $admin->bindParam(':passwd', $contrasena);


if($admin->execute()){
  echo "todo bien<br>";
}
else{
  echo "todo mal<br>";
}



$idEmpleado=$conn->lastInsertId();



if($tipo_usuario=="administrador"){
  $sqlAdministrador="INSERT INTO administrator(id)
                      VALUES (:id)";
  $administrador=$conn->prepare($sqlAdministrador);
  $administrador->bindParam(':id', $idEmpleado);
  if($administrador->execute()){
    echo "Se ha añadido un nuevo administrador<br>";
  }
  else{
    echo "No se ha podido añadir un nuevo administrador<br>";
  }
}
  else if($tipo_usuario=="administrativo"){
    $sqlAdministrativo="INSERT INTO administrative(id)
                      VALUES (:id)";
  $administrativo=$conn->prepare($sqlAdministrativo);
  $administrativo->bindParam(':id', $idEmpleado);
  if($administrativo->execute()){
    echo "Se ha añadido un nuevo administrativo<br>";
  }
  else{
    echo "No se ha podido añadir un nuevo administrativo<br>";
  }
  };

  /*Mostrar Empleado registrado*/
  $sqlDatos = "SELECT * FROM employee";
  
  $resultado=$conn->query($sqlDatos);
  $resultado->setFetchMode(PDO::FETCH_ASSOC);
  
  $row=$resultado->fetch();
  echo $row['id']. "<br/>";
    echo $row['name']. "<br/>";
    echo $row['last_name']. "<br/>";
    echo $row['passwd']. "<br/>";
  
  /* Mostrar todos los datos de la consulta SQL
  while ($row=$resultado->fetch()) {
    echo $row['id']. "<br/>";
    echo $row['name']. "<br/>";
    echo $row['last_name']. "<br/>";
    echo $row['passwd']. "<br/>";
 }*/

 /*Seguridad csrf */
if (hash_equals($_SESSION["token"], $_POST["csrf_token"])) {
  echo "El token coincide" . "<br>";
  

if ($_SERVER['REQUEST_METHOD'] == "POST"){

if (!preg_match($patronNombre,$nombre)) {
    echo "El nombre es incorrecto " . "<br>" ;
  } else {
    echo "El nombre es correcto" . "<br>";
  }

  if (!preg_match($patronNombre,$apellido)) {
    echo "El apellido es incorrecto". "<br>";
  } else {
    echo "El apellido es correcto". "<br>";
  }

  if (!preg_match($patronEmail,$email)) {
    echo "El email es incorrecto". "<br>";
  } else {
    echo "El email es correcto". "<br>";
  }

  if (!preg_match($patronPass,$contrasena)) {
    echo "la contraseña es incorrecta". "<br>";
  } else {
    echo "La contraseña es correcta". "<br>";
  }

  if ($confirmarCon!=$contrasena) {
    echo "la contraseña no coincide". "<br>";
  } else {
    echo "La contraseña coincide". "<br>";
  }
}}

else {
  echo "El token no coincide" . "<br>";
}
?>