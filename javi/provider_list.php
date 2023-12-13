<?php

require_once __DIR__ . '/vendor/autoload.php';
$config = require_once __DIR__ . '/config/config.php';

use App\Core\Database;
use App\Core\Security;
use App\Core\View;
use App\Entity\Provider;
use App\Repository\ProviderRepository;

session_start();



$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$database = new Database($config["database"]);

$providerRepository = new ProviderRepository($database->getConnection(), Provider::class);
$providers = $providerRepository->findAll();

echo View::render('provider_list', 'backoffice', ["providers"=>$providers]);