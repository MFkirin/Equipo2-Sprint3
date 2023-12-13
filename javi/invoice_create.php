<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Core\View;
use App\Core\Security;
use App\Entity\Login;

session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);

echo View::render('invoice_create_confirmation', 'backoffice');