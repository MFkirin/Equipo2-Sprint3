<?php
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Login.php';
require_once __DIR__ . '/src/Repository/LoginRepository.php';
require_once __DIR__ . '/src/Validator/LoginValidator.php';

$config = require_once __DIR__ . '/config/config.php';

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
                    echo "Error en inserir les dades del proveïdor: " . $exception->getMessage();
                }
            } else {
                var_dump($loginToUpdate);
                var_dump($errors);
            }
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