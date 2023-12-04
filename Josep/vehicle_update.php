<?php
require_once __DIR__. '/src/Core/Database.php';
require_once __DIR__. '/src/Core/View.php';
require_once __DIR__. '/src/Entity/Vehicle.php';
require_once __DIR__. '/src/Repository/VehicleRepository.php';

$config = require_once __DIR__. '/config/config.php';

$database = new Database($config["database"]);
$vehicleRepository = new VehicleRepository($database->getConnection(), Vehicle::class);

if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
    exit;
}

$idToUpdate = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($idToUpdate !== false) {
    try {
        $vehicleToUpdate = $vehicleRepository->find($idToUpdate);
    } catch (RecordNotFoundException $e) {
    }

    if ($vehicleToUpdate !== null) {
        echo View::render('vehicle_update_confirmation', 'default', ["vehicleToUpdate" => $vehicleToUpdate]);
    } else {
        header("Location: /vehicle_list.php?error=Login no trobat");
        exit;
    }
} else {
    header("Location: /vehicle_list.php?error=ID no vàlid");
    exit;
}