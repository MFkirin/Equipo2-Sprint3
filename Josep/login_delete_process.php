<?php
require_once __DIR__. '/src/Core/Database.php';
require_once __DIR__. '/src/Core/View.php';
require_once __DIR__. '/src/Entity/Login.php';
require_once __DIR__. '/src/Repository/LoginRepository.php';

$config = require_once __DIR__. '/config/config.php';

$database = new Database($config["database"]);
$loginRepository = new LoginRepository($database->getConnection(), Login::class);

// Comprovar si hi ha un paràmetre d'error a la URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
    exit;
}

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
            // Eliminar el login
            $loginRepository->delete($loginToDelete);

            // Redirigir a login_list.php després de l'eliminació
            header("Location: /login_list.php");
            exit;
        } else {
            // Gestionar el cas en què el login no es troba
            header("Location: /login_list.php?error=Login no trobat");
            exit;
        }
    } else {
        // Gestionar el cas en què l'ID no és un enter vàlid
        header("Location: /login_list.php?error=ID no vàlid");
        exit;
    }
} else {
    // Si no s'ha enviat el formulari, redirigir a login_list.php
    header("Location: /login_list.php");
    exit;
}