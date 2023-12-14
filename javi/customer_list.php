<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Core\View;
use App\Entity\Customer;
use App\Repository\CustomerRepository;

$config = require __DIR__ . '/config/config.php';

$database = new Database($config["database"]);

// Comprovar si hi ha un paràmetre d'error a la URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
}

$customerRepository = new CustomerRepository($database->getConnection(), Customer::class);
$customers = $customerRepository->findAll();

echo View::render('customer_list', 'default', ["customers" => $customers]);