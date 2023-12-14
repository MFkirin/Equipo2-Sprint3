<?php
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
$invoiceRepository = new InvoiceRepository($database->getConnection(), Invoice::class);
$customerRepository = new CustomerRepository($database->getConnection(), Customer::class);

// Obtindre l'ID de la factura des de la URL
$idToDelete = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Verificar si l'ID és vàlid abans d'intentar eliminar
if ($idToDelete !== false) {
    // Obtindre el login per ID
    $invoiceToDelete = $invoiceRepository->find($idToDelete);
    $customer = $customerRepository->find($invoiceToDelete->getCustomerId());
    $invoiceToDelete->setCustomer($customer);

    // Verificar si s'ha trobat la factura abans de mostrar la vista de confirmació
    if ($invoiceToDelete !== null) {
        echo View::render('invoice_delete_confirmation', 'backoffice', ["invoiceToDelete" => $invoiceToDelete]);
    } else {
        // Gestionar el cas en què la factura no es troba
        FlashMessage::set("message", "Factura no trobada");
        header('Location: /invoice_list.php');
        exit;
    }
} else {
    // Gestionar el cas en què l'ID no és un enter vàlid
    FlashMessage::set("message", "ID no vàlid");
    header('Location: /invoice_list.php');
    exit;
}