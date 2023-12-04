

<?php
session_start();
include 'Empleado.php';
//include 'FormRegistAdmin.php';
$ID = rand(0,1000);
$nombre = $_POST['nombre'];
$apellido = $_POST['Apellido'];
$tipo = "Empleado";
$email = $_POST['correo'];
$contrasena = $_POST['Contraseña'];
$confirmarCon = $_POST["confirmarContraseña"];

$patronNombre="/[A-Za-z]{1,30}/";
$patronEmail=" /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/ ";
$patronPass="/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$^&*()_-]).{8,18}$/";

//$empleadoValidar=new Empleado($ID,$nombre,$apellido,$tipo,$email,$constrasena);
//echo $empleadoValidar->ID;





  //$token=csrf::getTokenCSRF();
//echo $token;
/*if (csrf::checkTokenCSRF($_POST['csrf_token'])) {
  echo "El token es válido";
} else {
  echo "El token no es válido";
} */
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