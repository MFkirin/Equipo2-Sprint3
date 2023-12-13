<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Core\View;
use App\Entity\Vehicle;
use App\Entity\Model;
use App\Entity\Brand;
use App\Entity\Image;
use App\Entity\Order;
use App\Entity\Customer;
use App\Repository\VehicleRepository;
use App\Repository\ModelRepository;
use App\Repository\BrandRepository;
use App\Repository\ImageRepository;
use App\Repository\OrderRepository;
use App\Repository\CustomerRepository;
use App\Core\Security;
use App\Helper\FlashMessage;
use App\Entity\Login;

session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require_once __DIR__ . '/config/config.php';

try {
    $database = new Database($config["database"]);

    $vehicleRepository = new VehicleRepository($database->getConnection(), Vehicle::class);
    $modelRepository = new ModelRepository($database->getConnection(), Model::class);
    $brandRepository = new BrandRepository($database->getConnection(), Brand::class);
    $imageRepository = new ImageRepository($database->getConnection(), Image::class);
    $orderRepository = new OrderRepository($database->getConnection(), Order::class);
    $customerRepository = new CustomerRepository($database->getConnection(), Customer::class);

    $customerId = $_SESSION["loginToken"]->getId();

    $activeOrder = $orderRepository->findActiveOrderByCustomer($customerId);

    if (!$activeOrder) {
        echo View::render('garage_empty');
        exit;
    }

    $totalPrice = 0;
    $customer = $customerRepository->find($customerId);
    $activeOrderId = $activeOrder->getId();
    $vehicleIdsInOrder = $vehicleRepository->findByOrderId($activeOrderId);

    $vehiclesInOrder = [];
    foreach ($vehicleIdsInOrder as $vehicle) {

        $modelId = $vehicle->getModelId();
        $model = $modelRepository->find($modelId);
        $vehicle->setModel($model);

        $brandId = $model->getBrandId();
        $brand = $brandRepository->find($brandId);
        $model->setBrand($brand);

        $images = $imageRepository->findAllByVehicleId($vehicle->getId());
        $vehicle->setImages($images);

        $vehiclesInOrder[] = $vehicle;

        $totalPrice += $vehicle->getSellPrice();
    }
    $activeOrder->setCustomer($customer);
    $activeOrder->setTotalPrice($totalPrice);

    echo View::render('garage_list', 'default', ["vehicles" => $vehiclesInOrder, "activeOrder" => $activeOrder, "customer" => $customer]);
} catch (Exception $e) {
    FlashMessage::set("message", "Error: " . $e->getMessage());
    header('Location: /index.php');
    exit;
}