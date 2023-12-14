<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Core\View;
use App\Core\Database;
use App\Entity\Brand;
use App\Entity\Image;
use App\Entity\Model;
use App\Entity\Vehicle;
use App\Helper\FlashMessage;
use App\Repository\BrandRepository;
use App\Repository\ImageRepository;
use App\Repository\ModelRepository;
use App\Repository\VehicleRepository;

session_start();

$config = require_once __DIR__ . '/config/config.php';

try {
    $database = new Database($config["database"]);

    if (isset($_GET['id'])) {
        $vehicleId = (int)$_GET['id'];

        // Crear el repositori i carregar el vehicle des de la base de dades
        $vehicleRepository = new VehicleRepository($database->getConnection(), Vehicle::class);
        $vehicle = $vehicleRepository->find($vehicleId);

        $modelRepository = new ModelRepository($database->getConnection(), Model::class);
        $brandRepository = new BrandRepository($database->getConnection(), Brand::class);
        $imageRepository = new ImageRepository($database->getConnection(), Image::class);

        // Verificar si el vehicle existeix
        if ($vehicle) {

            $modelId = $vehicle->getModelId();
            $model = $modelRepository->find($modelId);
            $vehicle->setModel($model);

            $brandId = $model->getBrandId();
            $brand = $brandRepository->find($brandId);
            $model->setBrand($brand);

            $vehicleId = $vehicle->getId();
            $images = $imageRepository->findAllByVehicleId($vehicleId);
            $vehicle->setImages($images);

            echo View::render('vehicle_detail', 'default', ["vehicle" => $vehicle]);
        } else {
            // Si el vehicle no existeix, redirigir a la pàgina de catàleg amb un missatge d'error
            FlashMessage::set("message", "Error: Vehicle no trobat");
            header('Location: /catalogue_list.php');
            exit;
        }
    } else {
        // Si no es proporciona un ID de vehicle, redirigir a la pàgina de catàleg
        FlashMessage::set("message", "Error: ID de vehicle no vàlid.");
        header('Location: /catalogue_list.php');
        exit;
    }
} catch (Exception $e) {
    FlashMessage::set("message", "Error: " . $e->getMessage());
    header('Location: /catalogue_list.php');
    exit;
}