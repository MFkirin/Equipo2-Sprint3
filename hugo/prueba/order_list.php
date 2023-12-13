<?php
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Order.php';
require_once __DIR__ . '/src/Entity/Customer.php';
require_once __DIR__ . '/src/Entity/Vehicle.php';
require_once __DIR__ . '/src/Repository/OrderRepository.php';
require_once __DIR__ . '/src/Repository/CustomerRepository.php';
require_once __DIR__ . '/src/Repository/VehicleRepository.php';

$config = require_once __DIR__ . '/config/config.php';
try {
    $database = new Database($config["database"]);

    // Comprobar si hay un parámetro de error en la URL
    if (isset($_GET['error'])) {
        $errorMessage = $_GET['error'];
        throw new Exception("Error: $errorMessage");
    }

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
    echo "Error: " . $e->getMessage();
}