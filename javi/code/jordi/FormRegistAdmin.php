<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" src="RegistroAdmin.css" type="text/css">
    <meta charset="utf-8">
    <title>Formulario Registro Administradores</title>
  <script src="RegistroAdmin.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    
    .error {
        color: red;
    }
    #myModal {
    display: none;
    text-align: center;
  position:absolute;
  padding-top: 100px;
    
    top: 20%;
    right: 40%;
    bottom: 40%;
    left: 40%;
    background-color: white;
    border: solid;
  }
    /*input[type="text"]:valid {
    background-color: white;
} */
</style>
<body>
    <?php 
    session_start();
    $token = bin2hex(random_bytes(24));
    $_SESSION["token"]=$token;
    ?>
    <h1>Formulario Administradores</h1>
     <!-- 
<form action="EmpleadoVali.php" id="registroForm" method="post" novalidate ="novalidate">
     En este form nos redireccionara a la creacion de PDF-->
    <form action="EmpleadoVali.php" id="registroForm" method="post" novalidate ="novalidate">
        <input type="hidden" id="token" name="csrf_token" value= "<?= $token ?>">
        <script>
            //El siguiente script muestra el valor del input con ID=token
            const mostrar=document.getElementById("token").value;
            console.log (mostrar);
            </script>
        <ul>
            <li>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required class="input" ><span id="nombreError" class="error"></span>
            </li>
            <li>
                <label for="apellido">Apellido:</label>
                <input type="text" name="Apellido" id="apellido" required class="input"><span id="apellidoError" class="error"></span>
            </li>
            <li>
                <label for="mail">Correo electrónico:</label>
                <input type="email" name="correo" id="correo" required class="input"><span id="correoError" class="error"></span>
            </li>
            <li>
                <label for="pass">Contraseña:</label>
                <input type="password" name="Contraseña" id="password" required class="input"><span id="passwordError"
                    class="error"></span>
            </li>
            <li>
                <label for="confirm_pass">Confirmar Contraseña:</label>
                <input type="password" name="confirmarContraseña" id="confirmPass" required class="input"><span id="confirmPassError"
                    class="error"></span>
            </li>
            <li>
                <button name="button" type="submit" id="confirmar">Enviar</button>
            </li>
        </ul>

        
    </form>
    <script src="sweetalert2.all.min.js"></script>
    <div>
        <button id="cookie" name="cookies" type="button">Aceptar</button>
        <button id="mostrar" name="mostrar" type="button">Mostrar Cookie</button>
        <button id="mostrarT" name="mostrat" type="button">Mostrar Todas las Cookies</button>
        <button  id="btnModal">Modal</button>
        <!--Boton para realizar el submit -->
        <button  id="btnModalSweet">ModalSweet</button>
    </div>

    <div class="modal"  id="myModal" >
       
                  <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                  <h4 class="modal-title">Pulsa confirmar si estas conforme</h4>
                  <button type="submit"  id="aceptar">Aceptar</button>
                  <button  id="cancelar">Cancelar</button>
                  
                </div>


    <div>
        <ul id="ul"></ul>
    </div>
</body>

</html>