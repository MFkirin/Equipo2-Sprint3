<?php
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Entity/Vehicle.php';
require_once __DIR__ . '/src/Entity/Image.php';
require_once __DIR__ . '/src/Repository/VehicleRepository.php';
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
$imageRepository = new ImageRepository($database->getConnection(), Image::class);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idToDelete = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($idToDelete !== false) {
        $vehicleToDelete = $vehicleRepository->find($idToDelete);

        if ($vehicleToDelete !== null) {
            $imagesToDelete = $imageRepository->findByVehicleId($idToDelete);
            foreach ($imagesToDelete as $image) {
                $imageRepository->delete($image);
            }

            $vehicleRepository->delete($vehicleToDelete);

            header("Location: /vehicle_list.php");
            exit;
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
} else {
    header('Location: /vehicle_list.php');
    exit;
}