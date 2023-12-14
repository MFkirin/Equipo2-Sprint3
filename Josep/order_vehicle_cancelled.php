<?php
declare(strict_types=1);

require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Entity/Order.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Repository/OrderRepository.php';
require_once __DIR__ . '/src/Entity/Vehicle.php';
require_once __DIR__ . '/src/Repository/VehicleRepository.php';
require_once __DIR__ . '/src/Core/Security.php';
require_once __DIR__ . '/src/Helper/FlashMessage.php';
require_once __DIR__ . '/src/Entity/Login.php';

session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require_once __DIR__ . '/config/config.php';

try {
    $database = new Database($config['database']);

    if (!isset($_POST['order_id']) || $_POST['order_id'] < 0) {
        FlashMessage::set('message', 'ID de pedido no válido.');
        header('Location: /garage_list.php');
        exit;
    }

    $idToDelete = filter_input(INPUT_POST, 'order_id', FILTER_VALIDATE_INT);

    $orderRepository = new OrderRepository($database->getConnection(), Order::class);
    $order = $orderRepository->find($idToDelete);

    $customerRepository = new CustomerRepository($database->getConnection(), Customer::class);
    $vehicleRepository = new VehicleRepository($database->getConnection(), Vehicle::class);

    if ($order) {
        $customer = $customerRepository->find($order->getCustomerId());

        if ($customer) {
            $order->setCustomer($customer);
            $vehicles = $vehicleRepository->findByOrderId($order->getId());
            $order->setVehicles($vehicles);

            $order->setTotalPrice(array_sum(array_map(function ($vehicle) {
                return $vehicle->getSellPrice();
            }, $order->getVehicles())));

            echo View::render('order_vehicle_cancelled', 'default', ["order" => $order]);
            exit;
        } else {
            FlashMessage::set("message", "Pedido no encontrado");
            header('Location: garage_list.php');
            exit;
        }
    } else {
        header("Location: /garage_list.php");
        exit;
    }
} catch (Exception $e) {
    FlashMessage::set('message', 'Error: ' . $e->getMessage());
    header('Location: /garage_list.php');
    exit;
}