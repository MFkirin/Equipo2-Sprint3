<?php
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Login.php';
require_once __DIR__ . '/src/Repository/LoginRepository.php';
require_once __DIR__ . '/src/Validator/LoginValidator.php';
require_once __DIR__ . '/src/Helper/FlashMessage.php';
session_start();

//No la restringixc a admins per a que puguen crearse nous logins

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$loginRepository = new LoginRepository($database->getConnection(), Login::class);

// Verificar si s'ha enviat el formulari de confirmació
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errors = [];
    $validator = new LoginValidator($config);

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
            FlashMessage::set("message", "Error en insertar les dades del proveïdor: " . $exception->getMessage());
            header('Location: login_create.php');
            exit;
        }
    } else {
        // Redirigir a la pàgina de creació amb missatges d'error
        $errorMessages = implode(', ', $errors);
        FlashMessage::set("message", "Errors de validació: $errorMessages");
        header('Location: login_create.php');
        exit;
    }
} else {
    // Gestionar el cas en què el login no es trobat
    FlashMessage::set("message", "Login no trobat");
    header('Location: login_list.php');
    exit;
}