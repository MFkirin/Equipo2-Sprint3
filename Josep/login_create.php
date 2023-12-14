<?php
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Login.php';
require_once __DIR__ . '/src/Repository/LoginRepository.php';
require_once __DIR__ . '/src/Helper/FlashMessage.php';
session_start();

//No la restringixc a admins per a que puguen crearse nous logins

$config = require_once __DIR__ . '/config/config.php';
$database = new Database($config["database"]);

echo View::render('login_create_confirmation');