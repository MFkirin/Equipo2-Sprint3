<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Iniciar sesión</h1>
        <form id="form-control" action="login.php" method="post">
            <div class="form-group">
                <input type="hidden" id="csrf_token" name="csrf_token" value="<?= $token ?>">
                <label for="email">Correo electrónico: </label>
                <input type="text" id="email" name="email" placeholder="Correo electrónico" required pattern="[^\sáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜ]+@[^\sáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜ]+\.[^\sáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜ]{2,}$">
            </div>

            <div class="form-group">
                <label for="password">Contraseña: </label>
                <input type="password" id="password" name="password" placeholder="Contraseña" required pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])(?=.*[^A-Za-z0-9]).{8,16}$">
            </div>

            <div class="form-group">
                <p>
                    <a href="#contraseña">¿Has olvidado la contraseña?</a>
                </p>
                <input type="submit" id="submit" value="Iniciar sesión">
                <p>
                    ¿No tienes cuenta? <a href="../FormularioEmpleado/FormRegistAdmin.php">Regístrate ahora</a>
                </p>
            </div>
        </form>
        <div class="error-message" id="errorMessage"></div>
    </div>
</body>

</html>