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

// Verificar si s'ha enviat el formulari de confirmació
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtindre l'ID del login a eliminar
    $idToDelete = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    // Verificar si l'ID és vàlid abans d'intentar eliminar
    if ($idToDelete !== false) {
        // Obtindre el login per ID
        $loginToDelete = $loginRepository->find($idToDelete);

        // Verificar si s'ha trobat el login abans d'intentar eliminar-lo
        if ($loginToDelete !== null) {
            try {
                // Intentar eliminar el login
                $loginRepository->delete($loginToDelete);

                // Redirigir a login_list.php después de la eliminación
                header("Location: /login_list.php");
                exit;
            } catch (\Exception $exception) {
                // Manejar la excepción
                FlashMessage::set("message", "Error al eliminar el registro: " . $exception->getMessage());
                header('Location: login_list.php');
                exit;
            }

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
} else {
    // Si no s'ha enviat el formulari, redirigir a login_list.php
    FlashMessage::set("message", "No s'ha enviat el formulari");
    header('Location: login_list.php');
    exit;
}