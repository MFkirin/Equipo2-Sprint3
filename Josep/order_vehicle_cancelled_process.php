<?php
declare(strict_types=1);

require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Entity/Order.php';
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

    $orderId = (int)$_POST['order_id'];

    $orderRepository = new OrderRepository($database->getConnection(), Order::class);
    $vehicleRepository = new VehicleRepository($database->getConnection(), Vehicle::class);

    $order = $orderRepository->find($orderId);

    // Verifica si el pedido existe
    if (!$order) {
        FlashMessage::set('message', 'El pedido no existe.');
        header('Location: /garage_list.php');
        exit;
    }

    $vehicles = $vehicleRepository->findByOrderId($orderId);

    foreach ($vehicles as $vehicle) {
        $vehicleRepository->updateOrderForVehicle($vehicle->getId());
    }

    $orderRepository->delete($order);

    FlashMessage::set('message', 'Pedido cancelado exitosamente.');

    header('Location: /garage_list.php');
    exit;
} catch (Exception $e) {
    FlashMessage::set('message', 'Error: ' . $e->getMessage());
    header('Location: /garage_list.php');
    exit;
}