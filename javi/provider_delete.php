<?php
require_once __DIR__ . '/vendor/autoload.php';
$config = require __DIR__ . '/config/config.php';

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
// TODO: validar el $_GET[id]
$id = $_GET["id"] ?? "";
$filtredProvider = $providerRepository->find($id);

echo View::render('provider_delete', 'backoffice', ["provider"=>$filtredProvider]);
