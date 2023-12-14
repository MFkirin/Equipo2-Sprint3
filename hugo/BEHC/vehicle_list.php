<?php
require_once __DIR__. '/src/Core/Database.php';
require_once __DIR__. '/src/Core/View.php';
require_once __DIR__. '/src/Entity/Vehicle.php';
require_once __DIR__. '/src/Repository/VehicleRepository.php';

$config = require_once __DIR__. '/config/config.php';

$database = new Database($config["database"]);

if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
}

$vehicleRepository = new VehicleRepository($database->getConnection(), Vehicle::class);
$vehicles = $vehicleRepository->findAll();

echo View::render('vehicle_list', 'default', ["vehicles" => $vehicles]);