<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Core\Security;
use App\Core\View;
use App\Entity\Provider;
use App\Repository\ProviderRepository;

session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require __DIR__ . '/config/config.php';

$database = new Database($config["database"]);


$providerRepository = new ProviderRepository($database->getConnection(), Provider::class);
$id = $_GET["id"] ?? "";
$filtredProvider = $providerRepository->find($id);

echo View::render('provider_update', 'backoffice',["provider"=>$filtredProvider]);