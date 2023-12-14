<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Core\Database;
use App\Core\Security;
use App\Entity\Image;
use App\Entity\Vehicle;
use App\Helper\FlashMessage;
use App\Repository\ImageRepository;
use App\Repository\VehicleRepository;
use App\Validator\VehicleValidator;

session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$vehicleRepository = new VehicleRepository($database->getConnection(), Vehicle::class);
$imageRepository = new ImageRepository($database->getConnection(), Image::class);

if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    $validator = new VehicleValidator();
    $uploadDirectory = 'assets/img/';

    $newVehicleArray = [
        "id" => 0,
        'plate' => $_POST['plate'],
        'observed_damages' => $_POST['observed_damages'],
        'kilometers' => intval($_POST['kilometers']),
        'buy_price' => floatval($_POST['buy_price']),
        'sell_price' => floatval($_POST['sell_price']),
        'fuel' => $_POST['fuel'],
        'iva' => floatval($_POST['iva']),
        'description' => $_POST['description'],
        'chassis_number' => $_POST['chassis_number'],
        'gearbox' => $_POST['gearbox'],
        'is_new' => $_POST['is_new'],
        'transport_included' => $_POST['transport_included'],
        'color' => $_POST['color'],
        'registration_date' => $_POST['registration_date'],
        'provider_id' => $_POST['provider_id'],
        'model_id' => $_POST['model_id'],
    ];

    $newVehicle = Vehicle::fromArray($newVehicleArray);
    $errors = $validator->validate($newVehicle);

    if (empty($errors)) {
        try {
            $vehicleRepository->create($newVehicle);
            $newVehicleId = (int)$database->getConnection()->lastInsertId();

            if (!empty($_FILES['image']['name'][0])) {
                foreach ($_FILES['image']['name'] as $key => $filename) {
                    $uploadFile = $uploadDirectory . basename($filename);

                    $newImageArray = [
                        "id" => 0,
                        'filename' => $filename,
                        "vehicle_id" => $newVehicleId,
                    ];

                    $newImage = Image::fromArray($newImageArray);
                    $imageRepository->create($newImage);
                    move_uploaded_file($_FILES['image']['tmp_name'][$key], $uploadFile);
                }
            }

            header("Location: /vehicle_list.php");
            exit;
        } catch (Exception $exception) {
            FlashMessage::set("message", "Error en insertar les dades: " . $exception->getMessage());
            header('Location: /vehicle_create.php');
            exit;
        }
    } else {
        $errorMessages = implode(', ', $errors);
        FlashMessage::set("message", "Errors de validació: $errorMessages");
        header('Location: /vehicle_create.php');
        exit;
    }
} else {
    FlashMessage::set("message", "Vehicle no trobat");
    header('Location: /vehicle_list.php');
    exit;
}