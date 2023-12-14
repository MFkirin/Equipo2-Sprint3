<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Core\Database;
use App\Core\Security;
use App\Core\View;
use App\Entity\Vehicle;
use App\Exception\RecordNotFoundException;
use App\Helper\FlashMessage;
use App\Repository\VehicleRepository;

session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$vehicleRepository = new VehicleRepository($database->getConnection(), Vehicle::class);

$idToDelete = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($idToDelete !== false) {
    try {
        $vehicleToDelete = $vehicleRepository->find($idToDelete);
    } catch (RecordNotFoundException $e) {
    }

    if ($vehicleToDelete !== null) {
        echo View::render('vehicle_delete_confirmation', 'backoffice', ["vehicleToDelete" => $vehicleToDelete]);
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