<?php
require_once __DIR__. '/src/Core/Database.php';
require_once __DIR__. '/src/Core/View.php';
require_once __DIR__. '/src/Entity/Login.php';
require_once __DIR__. '/src/Repository/LoginRepository.php';

$config = require_once __DIR__. '/config/config.php';

$database = new Database($config["database"]);
$loginRepository = new LoginRepository($database->getConnection(), Login::class);

if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
    exit;
}

$idToUpdate = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($idToUpdate !== false) {
    try {
        $loginToUpdate = $loginRepository->find($idToUpdate);
    } catch (RecordNotFoundException $e) {
    }

    if ($loginToUpdate !== null) {
        echo View::render('update_confirmation', 'default', ["loginToUpdate" => $loginToUpdate]);
    } else {
        header("Location: /login_list.php?error=Login no trobat");
        exit;
    }
} else {
    header("Location: /login_list.php?error=ID no vàlid");
    exit;
}