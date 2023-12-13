<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Core\View;
use App\Entity\Order;
use App\Entity\Customer;
use App\Entity\Vehicle;
use App\Repository\OrderRepository;
use App\Repository\CustomerRepository;
use App\Repository\VehicleRepository;
use App\Helper\FlashMessage;
use App\Entity\Login;
use App\Core\Security;

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