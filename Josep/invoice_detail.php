<?php
declare(strict_types=1);

require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Invoice.php';
require_once __DIR__ . '/src/Repository/InvoiceRepository.php';
require_once __DIR__ . '/src/Entity/Customer.php';
require_once __DIR__ . '/src/Repository/CustomerRepository.php';
require_once __DIR__ . '/src/Helper/FlashMessage.php';
require_once __DIR__ . '/src/Entity/Login.php';
require_once __DIR__ . '/src/Core/Security.php';
session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);

// Verificar si s'ha proporcionat un ID de factura a la URL
if (isset($_GET['id'])) {
    $invoiceId = (int)$_GET['id'];

    // Crear el repositori i carregar la factura des de la base de dades
    $invoiceRepository = new InvoiceRepository($database->getConnection(), Invoice::class);
    $invoice = $invoiceRepository->find($invoiceId);

    $customerRepository = new CustomerRepository($database->getConnection(), Customer::class);

    // Verificar si la factura existeix
    if ($invoice) {
        $customer = $customerRepository->find($invoice->getCustomerId());
        if ($customer) {
            $invoice->setCustomer($customer);
            echo View::render('invoice_detail', 'backoffice', ["invoice" => $invoice]);
            exit;
        }
    } else {
        // Si la factura no existeix, redirigir a la pàgina de factures amb un missatge d'error
        FlashMessage::set("message", "Factura no trobada");
        header('Location: /invoice_list.php');
        exit;
    }
} else {
    // Si no es proporciona un ID de factura, redirigir a la pàgina de factures
    header("Location: /invoice_list.php");
    exit;
}