<?php
require_once __DIR__. '/src/Core/Database.php';
require_once __DIR__. '/src/Core/View.php';
require_once __DIR__. '/src/Entity/Model.php';
require_once __DIR__. '/src/Entity/Provider.php';
require_once __DIR__. '/src/Repository/ModelRepository.php';
require_once __DIR__. '/src/Repository/ProviderRepository.php';

$config = require_once __DIR__. '/config/config.php';

$database = new Database($config["database"]);

if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
}

$modelRepository = new ModelRepository($database->getConnection(), Model::class);
$models = $modelRepository->findAll();

$providerRepository = new ProviderRepository($database->getConnection(), Provider::class);
$providers = $providerRepository->findAll();

echo View::render('vehicle_create_confirmation', 'backoffice', ['models' => $models, 'providers' => $providers]);