<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Core\Database;
use App\Core\Security;
use App\Core\View;
use App\Entity\Model;
use App\Entity\Provider;
use App\Repository\ModelRepository;
use App\Repository\ProviderRepository;

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