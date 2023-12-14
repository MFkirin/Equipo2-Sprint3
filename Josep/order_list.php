<?php
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Order.php';
require_once __DIR__ . '/src/Entity/Customer.php';
require_once __DIR__ . '/src/Entity/Vehicle.php';
require_once __DIR__ . '/src/Repository/OrderRepository.php';
require_once __DIR__ . '/src/Repository/CustomerRepository.php';
require_once __DIR__ . '/src/Repository/VehicleRepository.php';
require_once __DIR__ . '/src/Helper/FlashMessage.php';
require_once __DIR__ . '/src/Entity/Login.php';
require_once __DIR__ . '/src/Core/Security.php';
session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require_once __DIR__ . '/config/config.php';
try {
    $database = new Database($config["database"]);

    $orderRepository = new OrderRepository($database->getConnection(), Order::class);
    $customerRepository = new CustomerRepository($database->getConnection(), Customer::class);
    $vehicleRepository = new VehicleRepository($database->getConnection(), Vehicle::class);

    $orders = $orderRepository->findAll();

    foreach ($orders as $order) {
        $customer = $customerRepository->find($order->getCustomerId());
        $order->setCustomer($customer);

        $vehicles = $vehicleRepository->findByOrderId($order->getId());
        $order->setVehicles($vehicles);

        $order->setTotalPrice(array_sum(array_map(function ($vehicle) {
            return $vehicle->getSellPrice();
        }, $order->getVehicles())));
    }

    echo View::render('order_list', 'backoffice', ["orders" => $orders]);

} catch (Exception $e) {
    FlashMessage::set("message", "Error al cargar la lista de pedidos: " . $e->getMessage());
    header('Location: index.php');
    exit;
}