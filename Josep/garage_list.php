<?php
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Vehicle.php';
require_once __DIR__ . '/src/Entity/Model.php';
require_once __DIR__ . '/src/Entity/Brand.php';
require_once __DIR__ . '/src/Entity/Image.php';
require_once __DIR__ . '/src/Entity/Order.php';
require_once __DIR__ . '/src/Entity/Customer.php';
require_once __DIR__ . '/src/Repository/VehicleRepository.php';
require_once __DIR__ . '/src/Repository/ModelRepository.php';
require_once __DIR__ . '/src/Repository/BrandRepository.php';
require_once __DIR__ . '/src/Repository/ImageRepository.php';
require_once __DIR__ . '/src/Repository/OrderRepository.php';
require_once __DIR__ . '/src/Repository/CustomerRepository.php';
require_once __DIR__ . '/src/Core/Security.php';
require_once __DIR__ . '/src/Helper/FlashMessage.php';
require_once __DIR__ . '/src/Entity/Login.php';
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