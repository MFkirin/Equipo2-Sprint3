<?php
require __DIR__ . '/src/Core/Database.php';
require __DIR__ . '/src/Core/View.php';
require __DIR__ . '/src/Entity/Provider.php';
require __DIR__ . '/src/Repository/ProviderRepository.php';

$config = require __DIR__ . '/config/config.php';

$database = new Database($config["database"]);

$providerRepository = new ProviderRepository($database->getConnection(), Provider::class);

$providers = $providerRepository->findAll();

echo View::render('provider_list', 'default', ["providers"=>$providers]);


