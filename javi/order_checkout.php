<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Entity\Invoice;
use App\Repository\InvoiceRepository;
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
    $orderRepository = new OrderRepository($database->getConnection(), Order::class);
    $invoiceRepository = new InvoiceRepository($database->getConnection(), Invoice::class);

    $customerId = $_SESSION["loginToken"]->getId();
    $activeOrder = $orderRepository->findActiveOrderByCustomer($customerId);

    if (!$activeOrder) {
        FlashMessage::set('message', 'No hay un pedido activo para tramitar.');
        header('Location: /garage.php');
        exit;
    }

    $invoice = new Invoice();
    $invoice->setId(0);
    $invoiceNumber = substr(bin2hex(random_bytes(3)), 0, 6);

    while ($invoiceRepository->findByNumber($invoiceNumber)) {
        $invoiceNumber = substr(bin2hex(random_bytes(3)), 0, 6);
    }

    $invoice->setNumber($invoiceNumber);
    $invoice->setPrice((float)$_POST["total_price"]);
    $invoice->setDate(new DateTime());
    $invoice->setCustomerId($customerId);
    $invoice->setOrderId($activeOrder->getId());

    $invoiceRepository->create($invoice);

    $activeOrder->setState('completed');
    $orderRepository->update($activeOrder);

    FlashMessage::set('message', 'Pedido tramitado exitosamente. Factura generada.');

    header('Location: /invoice_detail.php?id=' . $invoice->getId());
    exit;
} catch (Exception $e) {
    FlashMessage::set('message', 'Error: ' . $e->getMessage());
    header('Location: /garage_list.php');
    exit;
}