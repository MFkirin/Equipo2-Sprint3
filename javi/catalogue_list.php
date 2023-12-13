<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Core\View;
use App\Entity\Brand;
use App\Entity\Model;
use App\Helper\FlashMessage;
use App\Repository\BrandRepository;
use App\Repository\ImageRepository;
use App\Repository\ModelRepository;
use App\Repository\VehicleRepository;
use App\Entity\Image;
use App\Entity\Vehicle;

session_start();

$config = require_once __DIR__ . '/config/config.php';

try {
    $database = new Database($config["database"]);

    $vehicleRepository = new VehicleRepository($database->getConnection(), Vehicle::class);
    $modelRepository = new ModelRepository($database->getConnection(), Model::class);
    $brandRepository = new BrandRepository($database->getConnection(), Brand::class);
    $imageRepository = new ImageRepository($database->getConnection(), Image::class);

    $vehicles = $vehicleRepository->findAllOrderedByModel();

    foreach ($vehicles as $vehicle) {
        $modelId = $vehicle->getModelId();
        $model = $modelRepository->find($modelId);
        $vehicle->setModel($model);

        $brandId = $model->getBrandId();
        $brand = $brandRepository->find($brandId);
        $model->setBrand($brand);

        $vehicleId = $vehicle->getId();
        $images = $imageRepository->findAllByVehicleId($vehicleId);
        $vehicle->setImages($images);
    }

    echo View::render('catalogue_list', 'default', ["vehicles" => $vehicles]);
} catch (Exception $e) {
    FlashMessage::set("message", "Error: " . $e->getMessage());
    header('Location: /index.php');
    exit;
}