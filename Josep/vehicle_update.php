<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Core\Database;
use App\Core\Security;
use App\Core\View;
use App\Entity\Image;
use App\Entity\Model;
use App\Entity\Provider;
use App\Entity\Vehicle;
use App\Exception\RecordNotFoundException;
use App\Helper\FlashMessage;
use App\Repository\ImageRepository;
use App\Repository\ModelRepository;
use App\Repository\ProviderRepository;
use App\Repository\VehicleRepository;

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