<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Core\View;
use App\Entity\Login;
use App\Repository\LoginRepository;
use App\Core\Security;

session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);

$loginRepository = new LoginRepository($database->getConnection(), Login::class);
$logins = $loginRepository->findAll();

echo View::render('login_list', 'default', ["logins" => $logins]);