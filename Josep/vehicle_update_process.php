<?php
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Vehicle.php';
require_once __DIR__ . '/src/Repository/VehicleRepository.php';
require_once __DIR__ . '/src/Validator/VehicleValidator.php';

$config = require __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$vehicleRepository = new VehicleRepository($database->getConnection(), Vehicle::class);

if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idToUpdate = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($idToUpdate !== false) {
        $vehicleToUpdate = $vehicleRepository->find($idToUpdate);

        if ($vehicleToUpdate !== null) {

            $errors = [];
            //$validator = new VehicleValidator();

            $newVehicleArray = [
                'id' => $idToUpdate,
                'plate' => $_POST['plate'],
                'observed_damages' => $_POST['observed_damages'],
                'kilometers' => intval($_POST['kilometers']),
                'buy_price' => floatval($_POST['buy_price']),
                'sell_price' => floatval($_POST['sell_price']),
                'fuel' => $_POST['fuel'],
                'iva' => floatval($_POST['iva']),
                'description' => $_POST['description'],
                'chassis_number' => $_POST['chassis_number'],
                'gear_shift' => $_POST['gear_shift'],
                'is_new' => boolval($_POST['is_new']),
                'transport_included' => boolval($_POST['transport_included']),
                'color' => $_POST['color'],
                'registration_date' => $_POST['registration_date'],
                'provider_id' => $_POST['provider_id'],
                'model_id' => $_POST['model_id'],
            ];

            $newVehicle = Vehicle::fromArray($newVehicleArray);
            //$errors = $validator->validate($newVehicle);

            if (empty(array_filter($errors))) {
                try {
                    $vehicleRepository->update($newVehicle);

                    header("Location: /vehicle_list.php");
                    exit;
                } catch (Exception $exception) {
                    echo "Error updating vehicle data: " . $exception->getMessage();
                }
            } else {
                var_dump($vehicleToUpdate);
                var_dump($errors);
            }
        } else {
            header("Location: /vehicle_list.php?error=Vehicle not found");
            exit;
        }
    } else {
        header("Location: /vehicle_list.php?error=Invalid ID");
        exit;
    }
} else {
    header("Location: /vehicle_list.php");
    exit;
}