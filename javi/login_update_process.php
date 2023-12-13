<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Validator\LoginValidator;
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

// Verificar si s'ha enviat el formulari de confirmació
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtindre l'ID del login a editar
    $idToUpdate = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    // Verificar si l'ID és vàlid abans d'intentar editar
    if ($idToUpdate !== false) {
        // Obtindre el login per ID
        $loginToUpdate = $loginRepository->find($idToUpdate);

        // Verificar si s'ha trobat el login abans d'intentar editar
        if ($loginToUpdate !== null) {

            $errors = [];
            $validator = new LoginValidator($config);

            $newLoginArray = [
                'id' => $idToUpdate,
                'username' => $_POST['username'],
                'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
                'role' => $_POST['role'],
            ];

            $newLogin = Login::fromArray($newLoginArray);
            $errors = $validator->validate($newLogin);

            if (empty(array_filter($errors))) {
                try {
                    $loginRepository->update($newLogin);

                    // Redirigir a login_list.php després de l'edició
                    header("Location: /login_list.php");
                    exit;
                } catch (Exception $exception) {
                    FlashMessage::set("message", "Error en inserir les dades del proveïdor: " . $exception->getMessage());
                    header('Location: login_list.php');
                    exit;
                }
            } else {
                $errorMessages = implode(', ', $errors);
                FlashMessage::set("message", $errorMessages);
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