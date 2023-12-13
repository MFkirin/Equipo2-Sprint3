<?php


require __DIR__ . '/src/Core/Database.php';
require __DIR__ . '/src/Core/View.php';
require __DIR__ . '/src/Entity/Provider.php';
require __DIR__ . '/src/Repository/ProviderRepository.php';

$config = require __DIR__ . '/config/config.php';

$database = new Database($config["database"]);

$providerRepository = new ProviderRepository($database->getConnection(), Provider::class);
// TODO: validar el $_GET[id]
$id = $_GET["id"] ?? "";
$filtredProvider = $providerRepository->find($id);

echo View::render('provider_delete', 'backoffice', ["provider"=>$filtredProvider]);
