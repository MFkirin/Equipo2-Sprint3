<?php
declare(strict_types=1);

require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Invoice.php';
require_once __DIR__ . '/src/Repository/InvoiceRepository.php';


require_once __DIR__ . '/src/Entity/Customer.php';
require_once __DIR__ . '/src/Repository/CustomerRepository.php';

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);

// Comprovar si hi ha un paràmetre d'error a la URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
}

$customerRepository = new CustomerRepository($database->getConnection(), Customer::class);
$invoiceRepository = new InvoiceRepository($database->getConnection(), Invoice::class);
$invoices = $invoiceRepository->findAll();



foreach ($invoices as $invoice) {
    $customer = $customerRepository->find($invoice->getCustomerId());
    $invoice->setCustomer($customer);
}

echo View::render('invoice_list', 'backoffice', ["invoices" => $invoices]);