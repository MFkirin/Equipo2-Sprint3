<?php

require __DIR__ . '/src/Core/Database.php';
require __DIR__ . '/src/Core/View.php';
require __DIR__ . '/src/Entity/Login.php';
require __DIR__ . '/src/Repository/LoginRepository.php';
require __DIR__ . '/src/Validator/LoginValidator.php';

$config = require __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$loginRepository = new LoginRepository($database->getConnection(), Login::class);

// Comprovar si hi ha un paràmetre d'error a la URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    // TODO: Cal buscar una alternativa a aquest echo
    echo "Error: $errorMessage";
    exit;
}

// Verificar si s'ha enviat el formulari de confirmació
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errors = [];
    $validator = new LoginValidator();

    $newLoginArray = [
        "id" => 0,
        'username' => $_POST['username'],
        'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
        'role' => $_POST['role'],
    ];

    $newLogin = Login::fromArray($newLoginArray);
    $errors = $validator->validate($newLogin);

    if (empty($errors)) {
        try {
            $loginRepository->create($newLogin);

            // Redirigir a login_list.php després de la creació exitosa
            header("Location: /login_list.php");
            exit;
        } catch (Exception $exception) {
            // Redirigir a la pàgina de creació amb missatge d'error
            header("Location: /login_create.php?error=" . urlencode("Error en insertar les dades del proveïdor: " . $exception->getMessage()));
            exit;
        }
    } else {
        // Redirigir a la pàgina de creació amb missatges d'error
        $errorMessages = implode(', ', $errors);

        // TODO: millor usar variables de sessió per a la comunicació entre pàgines (controladors)
        header("Location: /login_create.php?error=" . urlencode("Errors de validació: $errorMessages"));
        exit;
    }
} else {
    // Gestionar el cas en què el login no es troba
    header("Location: /login_list.php?error=Login no trobat");
    exit;
}