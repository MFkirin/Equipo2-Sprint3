<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Entity\Vehicle;
use App\Repository\VehicleRepository;
use App\Entity\Customer;
use App\Repository\CustomerRepository;
use App\Core\Security;
use App\Helper\FlashMessage;
use App\Entity\Login;

session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require_once __DIR__ . '/config/config.php';

try {
    $database = new Database($config['database']);

    if (!isset($_POST['vehicle_id']) || $_POST['vehicle_id'] < 0) {
        FlashMessage::set('message', 'ID de vehículo no válido.');
        header('Location: /catalogue_list.php');
        exit;
    }

    $vehicleId = (int)$_POST['vehicle_id'];

    $orderRepository = new OrderRepository($database->getConnection(), Order::class);
    $vehicleRepository = new VehicleRepository($database->getConnection(), Vehicle::class);
    $customerRepository = new CustomerRepository($database->getConnection(), Customer::class);

    $customerId = $_SESSION["loginToken"]->getId();

    $activeOrder = $orderRepository->findActiveOrderByCustomer($customerId);
    $customer = $customerRepository->find($customerId);
    $vehicle = $vehicleRepository->find($vehicleId);

    if (!$activeOrder) {
        $order = new Order();
        $order->setId(0);
        $order->setState('processing');
        $order->setCustomerId($customerId);

        $orderRepository->create($order);

        $orderId = (int)$database->getConnection()->lastInsertId();

        $vehicleRepository->updateOrderForVehicle($vehicleId, $orderId);

        FlashMessage::set('message', 'Primer vehículo agregado al pedido exitosamente.');
    } else {
        $order = $activeOrder;
        $orderId = $order->getId();
        $activeVehicles = $vehicleRepository->findByOrderId($orderId);
        $vehicleAlreadyInOrder = false;

        foreach ($activeVehicles as $activeVehicle) {
            if ($activeVehicle->getId() == $vehicleId) {
                $vehicleAlreadyInOrder = true;
                break;
            }
        }

        if (!$vehicleAlreadyInOrder) {
            $vehicleRepository->updateOrderForVehicle($vehicleId, $orderId);
            $orderRepository->update($order);
            FlashMessage::set('message', 'Vehículo agregado a tu actual pedido exitosamente.');
        } else {
            FlashMessage::set('message', 'Este vehículo ya está en tu pedido.');
        }
    }
    header('Location: /garage_list.php');
    exit;

} catch (Exception $e) {
    FlashMessage::set('message', 'Error: ' . $e->getMessage());
    header('Location: /vehicle_detail.php?id=' . $vehicleId);
    exit;
}