<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Security;
use App\Core\View;

session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

echo View::render('provider_create', 'backoffice');


