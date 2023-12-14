<?php
declare(strict_types=1);

require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Invoice.php';
require_once __DIR__ . '/src/Repository/InvoiceRepository.php';
require_once __DIR__ . '/src/Helper/FlashMessage.php';
require_once __DIR__ . '/src/Entity/Login.php';
require_once __DIR__ . '/src/Core/Security.php';
session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

require_once __DIR__ . '/src/Entity/Customer.php';
require_once __DIR__ . '/src/Repository/CustomerRepository.php';

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);

$customerRepository = new CustomerRepository($database->getConnection(), Customer::class);
$invoiceRepository = new InvoiceRepository($database->getConnection(), Invoice::class);
$invoices = $invoiceRepository->findAll();

foreach ($invoices as $invoice) {
    $customer = $customerRepository->find($invoice->getCustomerId());
    $invoice->setCustomer($customer);
}

echo View::render('invoice_list', 'backoffice', ["invoices" => $invoices]);