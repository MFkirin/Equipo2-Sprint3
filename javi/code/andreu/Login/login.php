<!DOCTYPE html>
<html lang="es">

<head>
    <title>Log In</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>

<body>
    <?php
    ini_set("display_errors", "on");
    require_once 'Validator.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST)!=$_SERVER['HTTP_HOST']) {
            echo "Token válido.";

        $email = $_POST["email"] ?? "";
        $password = $_POST["password"] ?? "";

        $validator = new Validator($email, $password);

        if ($validator->validate()) { ?>
            <div class="container">
                <h1>Inicio sesión correcto</h1>
                <table>
                    <tr>
                        <th>Correo electrónico</th>
                        <th>Contraseña</th>
                    </tr>
                    <tr>
                        <td><?= $email ?></td>
                        <td><?= $password ?></td>
                    </tr>
                </table>
            </div>
    <?php } else {
            foreach ($validator->getErrors() as $error) {
                echo "<p>$error</p>";
            }
        }
    } else {
        echo "Token CSRF inválido.";
    }
    }
    ?>
</body>

</html>