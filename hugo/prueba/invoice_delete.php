<?php

require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Invoice.php';
require_once __DIR__ . '/src/Repository/InvoiceRepository.php';
require_once __DIR__ . '/src/Entity/Customer.php';
require_once __DIR__ . '/src/Repository/CustomerRepository.php';

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$invoiceRepository = new InvoiceRepository($database->getConnection(), Invoice::class);
$customerRepository = new CustomerRepository($database->getConnection(), Customer::class);

// Obtindre l'ID de la factura des de la URL
$idToDelete = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Verificar si l'ID és vàlid abans d'intentar eliminar
if ($idToDelete !== false) {
    // Obtindre el login per ID
    try {
        $invoiceToDelete = $invoiceRepository->find($idToDelete);
        $customer = $customerRepository->find($invoiceToDelete->getCustomerId());
        $invoiceToDelete->setCustomer($customer);
    } catch (RecordNotFoundException $e) {
    }

    // Verificar si s'ha trobat la factura abans de mostrar la vista de confirmació
    if ($invoiceToDelete !== null) {
        echo View::render('invoice_delete_confirmation', 'backoffice', ["invoiceToDelete" => $invoiceToDelete]);
    } else {
        // Gestionar el cas en què la factura no es troba
        header("Location: /invoice_list.php?error=Factura no trobada");
        exit;
    }
} else {
    // Gestionar el cas en què l'ID no és un enter vàlid
    header("Location: /invoice_list.php?error=ID no vàlid");
    exit;
}