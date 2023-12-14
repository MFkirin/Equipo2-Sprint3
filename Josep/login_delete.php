<?php
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Login.php';
require_once __DIR__ . '/src/Repository/LoginRepository.php';
require_once __DIR__ . '/src/Helper/FlashMessage.php';
require_once __DIR__ . '/src/Core/Security.php';
session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$loginRepository = new LoginRepository($database->getConnection(), Login::class);

// Obtindre l'ID del login des de la URL
$idToDelete = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Verificar si l'ID és vàlid abans d'intentar eliminar
if ($idToDelete !== false) {
    // Obtindre el login per ID
    try {
        $loginToDelete = $loginRepository->find($idToDelete);
    } catch (RecordNotFoundException $e) {
    }

    // Verificar si s'ha trobat el login abans de mostrar la vista de confirmació
    if ($loginToDelete !== null) {
        echo View::render('login_delete_confirmation', 'default', ["loginToDelete" => $loginToDelete]);
    } else {
        // Gestionar el cas en què el login no es troba
        FlashMessage::set("message", "Login no trobat");
        header('Location: login_list.php');
        exit;
    }
} else {
    // Gestionar el cas en què l'ID no és un enter vàlid
    FlashMessage::set("message", "ID no vàlid");
    header('Location: login_list.php');
    exit;
}