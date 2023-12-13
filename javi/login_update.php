<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Core\View;
use App\Entity\Login;
use App\Repository\LoginRepository;
use App\Core\Security;
use App\Helper\FlashMessage;

session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$loginRepository = new LoginRepository($database->getConnection(), Login::class);

// Obtindre l'ID del login des de la URL
$idToUpdate = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Verificar si l'ID és vàlid abans d'intentar editar
if ($idToUpdate !== false) {
    // Obtindre el login per ID
    try {
        $loginToUpdate = $loginRepository->find($idToUpdate);
    } catch (RecordNotFoundException $e) {
        FlashMessage::set("message", $e->getMessage());
        header('Location: login_list.php');
        exit;
    }

    // Verificar si s'ha trobat el login abans de mostrar la vista de confirmació
    if ($loginToUpdate !== null) {
        echo View::render('login_update_confirmation', 'default', ["loginToUpdate" => $loginToUpdate]);
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