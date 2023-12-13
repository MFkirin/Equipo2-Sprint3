<?php
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Model.php';
require_once __DIR__ . '/src/Entity/Provider.php';
require_once __DIR__ . '/src/Repository/ModelRepository.php';
require_once __DIR__ . '/src/Repository/ProviderRepository.php';
require_once __DIR__ . '/src/Helper/FlashMessage.php';
require_once __DIR__ . '/src/Core/Security.php';
session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);

$modelRepository = new ModelRepository($database->getConnection(), Model::class);
$models = $modelRepository->findAll();

$providerRepository = new ProviderRepository($database->getConnection(), Provider::class);
$providers = $providerRepository->findAll();

echo View::render('vehicle_create_confirmation', 'backoffice', ['models' => $models, 'providers' => $providers]);