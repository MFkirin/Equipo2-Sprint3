<?php
require_once __DIR__. '/src/Core/Database.php';
require_once __DIR__. '/src/Core/View.php';
require_once __DIR__. '/src/Entity/Vehicle.php';
require_once __DIR__. '/src/Repository/VehicleRepository.php';

$config = require_once __DIR__. '/config/config.php';

$database = new Database($config["database"]);
$vehicleRepository = new VehicleRepository($database->getConnection(), Vehicle::class);

$idToDelete = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($idToDelete !== false) {
    try {
        $vehicleToDelete = $vehicleRepository->find($idToDelete);
    } catch (RecordNotFoundException $e) {
    }

    if ($vehicleToDelete !== null) {
        echo View::render('vehicle_delete_confirmation', 'default', ["vehicleToDelete" => $vehicleToDelete]);
    } else {
        header("Location: /vehicle_list.php?error=Vehicle no trobat");
        exit;
    }
} else {
    header("Location: /vehicle_list.php?error=ID no vàlid");
    exit;
}