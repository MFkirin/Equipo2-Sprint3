<?php
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Vehicle.php';
require_once __DIR__ . '/src/Repository/VehicleRepository.php';
require_once __DIR__ . '/src/Entity/Model.php';
require_once __DIR__ . '/src/Entity/Provider.php';
require_once __DIR__ . '/src/Entity/Image.php';
require_once __DIR__ . '/src/Repository/ModelRepository.php';
require_once __DIR__ . '/src/Repository/ProviderRepository.php';
require_once __DIR__ . '/src/Repository/ImageRepository.php';
require_once __DIR__ . '/src/Helper/FlashMessage.php';
require_once __DIR__ . '/src/Core/Security.php';
session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$vehicleRepository = new VehicleRepository($database->getConnection(), Vehicle::class);

$modelRepository = new ModelRepository($database->getConnection(), Model::class);
$models = $modelRepository->findAll();

$providerRepository = new ProviderRepository($database->getConnection(), Provider::class);
$providers = $providerRepository->findAll();

$imageRepository = new ImageRepository($database->getConnection(), Image::class);
$images = $imageRepository->findAll();


$idToUpdate = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($idToUpdate !== false) {
    try {
        $vehicleToUpdate = $vehicleRepository->find($idToUpdate);
        $imagesForVehicle = $imageRepository->findAllByVehicleId($idToUpdate);
    } catch (RecordNotFoundException $e) {
        FlashMessage::set("message", "Error: " . $e->getMessage());
        header('Location: /vehicle_list.php');
        exit;
    }

    if ($vehicleToUpdate !== null) {
        echo View::render('vehicle_update_confirmation', 'backoffice', [
            "vehicleToUpdate" => $vehicleToUpdate,
            "models" => $models,
            "providers" => $providers,
            "imagesForVehicle" => $imagesForVehicle,
        ]);
    } else {
        FlashMessage::set("message", "Vehicle no trobat");
        header('Location: /vehicle_list.php');
        exit;
    }
} else {
    FlashMessage::set("message", "ID no vàlid");
    header('Location: /vehicle_list.php');
    exit;
}