<?php
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Vehicle.php';
require_once __DIR__ . '/src/Entity/Image.php';
require_once __DIR__ . '/src/Repository/VehicleRepository.php';
require_once __DIR__ . '/src/Repository/ImageRepository.php';
require_once __DIR__ . '/src/Validator/VehicleValidator.php';

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
    $idToUpdate = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($idToUpdate !== false) {
        $vehicleToUpdate = $vehicleRepository->find($idToUpdate);

        if ($vehicleToUpdate !== null) {

            $errors = [];
            $uploadDirectory = 'assets/img/';

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

            if (empty(array_filter($errors))) {
                try {
                    $vehicleRepository->update($newVehicle);

                    if (!empty($_FILES['image']['name'][0])) {
                        foreach ($_FILES['image']['name'] as $key => $filename) {
                            // Verificar errores de subida
                            if ($_FILES['image']['error'][$key] !== UPLOAD_ERR_OK) {
                                echo "Error al subir la imagen: {$_FILES['image']['error'][$key]}";
                                exit;
                            }

                            $uploadFile = $uploadDirectory . basename($filename);

                            $newImageArray = [
                                "id" => 0,
                                'filename' => $filename,
                                "vehicle_id" => $idToUpdate,
                            ];

                            $newImage = Image::fromArray($newImageArray);
                            $imageRepository->create($newImage);
                            move_uploaded_file($_FILES['image']['tmp_name'][$key], $uploadFile);
                        }
                    }

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