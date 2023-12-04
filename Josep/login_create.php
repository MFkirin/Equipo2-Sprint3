<?php

require_once __DIR__. '/src/Core/Database.php';
require_once __DIR__. '/src/Core/View.php';
require_once __DIR__. '/src/Entity/Login.php';
require_once __DIR__. '/src/Repository/LoginRepository.php';

$config = require_once __DIR__. '/config/config.php';

$database = new Database($config["database"]);

// Comprovar si hi ha un paràmetre d'error a la URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
}

echo View::render('create_confirmation', 'default');
