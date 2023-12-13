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

// Comprovar si hi ha un paràmetre d'error a la URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
}

// Verificar si se ha proporcionado un ID de pedido en la URL
if (isset($_GET['id'])) {
    $orderId = (int)$_GET['id'];

    // Crear el repositorio y cargar el pedido desde la base de datos
    $orderRepository = new OrderRepository($database->getConnection(), Order::class);
    $order = $orderRepository->find($orderId);

    $customerRepository = new CustomerRepository($database->getConnection(), Customer::class);
    $vehicleRepository = new VehicleRepository($database->getConnection(), Vehicle::class);

// Obté l'ID del pedido de la URL
    $orderId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Verifica si l'ID és vàlid
    if ($orderId !== false) {
        // Troba el pedido per ID
        try {
            $orderToUpdate = $orderRepository->find($orderId);
            $customer = $customerRepository->find($orderToUpdate->getCustomerId());
            $orderToUpdate->setCustomer($customer);

            if ($orderToUpdate !== null) {
                // Renderitza la vista d'actualització del pedido
                echo View::render('order_update_confirmation', 'backoffice', ["orderToUpdate" => $orderToUpdate]);
                exit;
            } else {
                // Redirigeix a order_list.php amb un missatge d'error si el pedido no es troba
                header("Location: /order_list.php?error=Pedido no trobat");
                exit;
            }
        } catch (\Exception $e) {
            // Gestionar errors al recuperar el pedido
            echo "Error al recuperar el pedido: " . $e->getMessage();
            exit;
        }
    }
} else {
    // Redirigeix a order_list.php amb un missatge d'error si l'ID no és vàlid
    header("Location: /order_list.php?error=ID no vàlid");
    exit;
}