<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Core\Database;
use App\Core\Security;
use App\Core\View;
use App\Entity\Vehicle;
use App\Repository\VehicleRepository;


session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require_once __DIR__. '/config/config.php';

$database = new Database($config["database"]);

$vehicleRepository = new VehicleRepository($database->getConnection(), Vehicle::class);
$vehicles = $vehicleRepository->findAll();

echo View::render('vehicle_list', 'backoffice', ["vehicles" => $vehicles]);