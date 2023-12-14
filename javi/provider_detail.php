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

$id = $_GET['id'];

$database = new Database($config["database"]);

$providerRepository = new ProviderRepository($database->getConnection(), Provider::class);
$provider = $providerRepository->find($id);

echo View::render('provider_detail', 'backoffice', ["provider"=>$provider]);