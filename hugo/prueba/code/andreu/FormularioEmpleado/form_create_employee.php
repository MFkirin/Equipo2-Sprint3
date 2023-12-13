<!DOCTYPE html>
<html lang="es">

<head>
    <title>Formulario Registro Administradores</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/styles_admin.css">
    <script src="js/main.js"></script>
    <script>
        //El siguiente script muestra el valor del input con ID=token
        const mostrar = document.getElementById("token").value;
        console.log(mostrar);
    </script>
</head>

<body>
<?php
session_start();
$token = bin2hex(random_bytes(24));
$_SESSION["token"] = $token;
?>
<div class="container">
    <h1>Formulario Administradores</h1>
    <form action="validate_employee.php" id="form-control" method="post" novalidate="novalidate">

        <input type="hidden" id="token" name="csrf_token" value="<?= $token ?>">

        <div class="form-group">
            <label for="id">ID:</label>
            <input type="text" name="id" id="id" required><span id="nombreError" class="error"></span>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required><span id="apellidoError" class="error"></span>
        </div>
        <div class="form-group">
            <label for="lastName">Last name:</label>
            <input type="text" name="lastName" id="lastName" required><span id="correoError" class="error"></span>
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <input type="text" name="type" id="type" required><span id="passwordError" class="error"></span>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><span id="confirmPassError" class="error"></span>
        </div>
        <div class="form-group">
            <button name="button" type="submit">Enviar</button>
        </div>
    </form>
</div>
<div>
    <button id="cookie" name="cookies" type="button">Aceptar</button>
    <button id="mostrar" name="mostrar" type="button">Mostrar Cookie</button>
    <button id="mostrarT" name="mostrat" type="button">Mostrar Todas las Cookies</button>
</div>
<div>
    <ul id="ul"></ul>
</div>
</body>

</html>