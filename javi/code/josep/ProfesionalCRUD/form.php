<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Cliente Profesional </title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<h1>Registrarse como profesional</h1>
<div class="container">
    <form action="professional_client_creation.php" method="POST">
        <div class="form">
            <div class="form-left">
                <div>
                    <label for="name">Nombre:</label><br>
                    <input id="name" name="name" type="text">
                </div>
                <div>
                    <label for="lastname">Apellidos:</label><br>
                    <input id="lastname" name="lastname" type="text">
                </div>
                <div>
                    <label for="email">Email:</label><br>
                    <input id="email" name="email" type="text">
                </div>
                <div>
                    <label for="username">Nombre de usuario:</label><br>
                    <input id="username" name="username" type="text">
                </div>
                <div>
                    <label for="address">Domicilio:</label><br>
                    <input id="address" name="address" type="text">
                </div>
                <div>
                    <label for="businessName">Nombre de la empresa:</label><br>
                    <input id="businessName" name="businessName" type="text">
                </div>
                <div>
                    <label for="dni">DNI:</label><br>
                    <input id="dni" name="dni" type="text">
                </div>
                <div>
                    <label for="phone">Telefono:</label><br>
                    <input id="phone" name="phone" type="tel">
                </div>
                <div>
                    <label for="targetNum">Target Number:</label><br>
                    <input id="targetNum" name="targetNum" type="text">
                </div>
            </div>
            <div class="form-right">
                <div>
                    <label for="cif">CIF:</label><br>
                    <input id="cif" name="cif" type="text">
                </div>
                <div>
                    <label for="managerNif">Manager NIF:</label><br>
                    <input id="managerNif" name="managerNif" type="text">
                </div>
                <div>
                    <label for="subscription">Subscription:</label><br>
                    <input id="subscription" name="subscription" type="text">
                </div>
                <div>
                    <label for="lopd">LOPD:</label><br>
                    <input id="lopd" name="lopd" type="file">
                </div>
                <div>
                    <label for="constitutionWriting">Constitution Writing:</label><br>
                    <input id="constitutionWriting" name="constitutionWriting" type="file">
                </div>
                <div>
                    <label for="passwd">Password:</label><br>
                    <input id="passwd" name="passwd" type="password">
                </div>
            </div>
            <input style="display:none" id="type" name="type" value="Professional">
            <div id="button">
                <button type="submit">Enviar</button>
            </div>
        </div>
    </form>
</div>

</body>
</html>