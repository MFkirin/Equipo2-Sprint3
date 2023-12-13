<?php

require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Order.php';
require_once __DIR__ . '/src/Repository/OrderRepository.php';
require_once __DIR__ . '/src/Entity/Customer.php';
require_once __DIR__ . '/src/Repository/CustomerRepository.php';
require_once __DIR__ . '/src/Entity/Vehicle.php';
require_once __DIR__ . '/src/Repository/VehicleRepository.php';

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$orderRepository = new OrderRepository($database->getConnection(), Order::class);
$customerRepository = new CustomerRepository($database->getConnection(), Customer::class);
$vehicleRepository = new VehicleRepository($database->getConnection(), Vehicle::class);

// Obtener el ID del pedido desde la URL
$idToDelete = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Verificar si el ID es válido antes de intentar eliminar
if ($idToDelete !== false) {
    // Obtener el pedido por ID
    try {
        $orderToDelete = $orderRepository->find($idToDelete);
        $customer = $customerRepository->find($orderToDelete->getCustomerId());
        $orderToDelete->setCustomer($customer);
        $vehicles = $vehicleRepository->findByOrderId($orderToDelete->getId());
        $orderToDelete->setVehicles($vehicles);

        $orderToDelete->setTotalPrice(array_sum(array_map(function ($vehicle) {
            return $vehicle->getSellPrice();
        }, $orderToDelete->getVehicles())));
    } catch (RecordNotFoundException $e) {
    }

    // Verificar si se ha encontrado el pedido antes de mostrar la vista de confirmación
    if ($orderToDelete !== null) {

        echo View::render('order_delete_confirmation', 'backoffice', ["orderToDelete" => $orderToDelete]);
    } else {
        // Gestionar el caso en que el pedido no se encuentra
        header("Location: /order_list.php?error=Pedido no encontrado");
        exit;
    }
} else {
    // Gestionar el caso en que el ID no es un entero válido
    header("Location: /order_list.php?error=ID no válido");
    exit;
}