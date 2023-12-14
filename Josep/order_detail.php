<?php
declare(strict_types=1);

require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Order.php';
require_once __DIR__ . '/src/Repository/OrderRepository.php';
require_once __DIR__ . '/src/Entity/Customer.php';
require_once __DIR__ . '/src/Repository/CustomerRepository.php';
require_once __DIR__ . '/src/Entity/Vehicle.php';
require_once __DIR__ . '/src/Repository/VehicleRepository.php';
require_once __DIR__ . '/src/Helper/FlashMessage.php';
require_once __DIR__ . '/src/Entity/Login.php';
require_once __DIR__ . '/src/Core/Security.php';
session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);

// Verificar si se ha proporcionado un ID de pedido en la URL
if (isset($_GET['id'])) {
    $orderId = (int)$_GET['id'];

    // Crear el repositorio y cargar el pedido desde la base de datos
    $orderRepository = new OrderRepository($database->getConnection(), Order::class);
    $order = $orderRepository->find($orderId);

    $customerRepository = new CustomerRepository($database->getConnection(), Customer::class);
    $vehicleRepository = new VehicleRepository($database->getConnection(), Vehicle::class);

    // Verificar si el pedido existe
    if ($order) {
        // Recuperar el cliente asociado al pedido
        $customer = $customerRepository->find($order->getCustomerId());

        // Verificar si el cliente existe
        if ($customer) {
            // Asignar el cliente al pedido y mostrar la página de detalles
            $order->setCustomer($customer);
            $vehicles = $vehicleRepository->findByOrderId($order->getId());
            $order->setVehicles($vehicles);

            $order->setTotalPrice(array_sum(array_map(function ($vehicle) {
                return $vehicle->getSellPrice();
            }, $order->getVehicles())));

            echo View::render('order_detail', 'backoffice', ["order" => $order]);
            exit;
        }
    } else {
        // Si el pedido no existe, redirigir a la página de pedidos con un mensaje de error
        FlashMessage::set("message", "Pedido no encontrado");
        header('Location: order_list.php');
        exit;
    }
} else {
    // Si no se proporciona un ID de pedido, redirigir a la página de pedidos
    header("Location: /order_list.php");
    exit;
}