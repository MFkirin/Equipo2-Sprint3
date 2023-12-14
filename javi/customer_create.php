<?php
declare(strict_types=1);

use App\Core\Database;
use App\Core\View;

require_once __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/config/config.php';

$database = new Database($config["database"]);

// Comprovar si hi ha un paràmetre d'error a la URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
}

echo View::render('customer_create_confirmation', 'default');
