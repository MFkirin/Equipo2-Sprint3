<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Core\View;
use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Entity\Customer;
use App\Repository\CustomerRepository;
use App\Entity\Vehicle;
use App\Repository\VehicleRepository;
use App\Helper\FlashMessage;
use App\Entity\Login;
use App\Core\Security;

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
                FlashMessage::set("message", "Pedido no encontrado");
                header('Location: order_list.php');
                exit;
            }
        } catch (\Exception $e) {
            // Gestionar errors al recuperar el pedido
            FlashMessage::set("message", "Error al recuperar el pedido: " . $e->getMessage());
            header('Location: order_list.php');
            exit;
        }
    }
} else {
    // Redirigeix a order_list.php amb un missatge d'error si l'ID no és vàlid
    FlashMessage::set("message", "ID no vàlid");
    header('Location: order_list.php');
    exit;
}