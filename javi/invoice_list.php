<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Core\View;
use App\Entity\Customer;
use App\Entity\Invoice;
use App\Repository\CustomerRepository;
use App\Repository\InvoiceRepository;
use App\Entity\Login;
use App\Core\Security;

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