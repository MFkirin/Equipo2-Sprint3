<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Core\View;

session_start();

//No la restringixc a admins per a que puguen crearse nous logins

$config = require_once __DIR__ . '/config/config.php';
$database = new Database($config["database"]);

echo View::render('login_create_confirmation');