<?php
require __DIR__ . '/src/Core/Database.php';
require __DIR__ . '/src/Core/View.php';
require __DIR__ . '/src/Entity/Provider.php';
require_once __DIR__ . '/src/Core/Security.php';
require_once __DIR__ . '/src/Helper/FlashMessage.php';
require __DIR__ . '/src/Repository/ProviderRepository.php';
require_once __DIR__ . '/src/Entity/Login.php';
session_start();

$config = require_once __DIR__ . '/config/config.php';

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$database = new Database($config["database"]);

$providerRepository = new ProviderRepository($database->getConnection(), Provider::class);
$providers = $providerRepository->findAll();

echo View::render('provider_list', 'backoffice', ["providers"=>$providers]);