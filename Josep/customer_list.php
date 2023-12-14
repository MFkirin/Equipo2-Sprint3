<?php
require __DIR__ . '/src/Core/Database.php';
require __DIR__ . '/src/Core/View.php';
require __DIR__ . '/src/Entity/Customer.php';
require __DIR__ . '/src/Repository/CustomerRepository.php';

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