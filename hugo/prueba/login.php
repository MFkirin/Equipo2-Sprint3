<?php
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Entity/Login.php';
require_once __DIR__ . '/src/Repository/LoginRepository.php';
require_once __DIR__ . '/src/Core/Security.php';
require_once __DIR__ . '/src/Helper/FlashMessage.php';
session_start();

$message = FlashMessage::get("message");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $config = require_once __DIR__ . '/config/config.php';

        $username = $_POST['username'] ?? "";
        $password = $_POST['password'] ?? "";

        //code for the token
        $database = new Database($config["database"]);
        $loginRepository = new LoginRepository($database->getConnection(), Login::class);

        $loginToken = Security::login($username, $password, $loginRepository);
        Security::setToken($loginToken);

        FlashMessage::set("message", "Ha iniciat sessió correctament");
    } catch (Exception $e) {
        FlashMessage::set("message", $e->getMessage());
        header('Location: login.php');
        exit;
    }

    header('Location: index.php');
    exit;
}

echo View::render('login', 'default', ['message'=>$message]);