<?php
require __DIR__ . '/src/Core/Database.php';
require __DIR__ . '/src/Core/View.php';
require __DIR__ . '/src/Entity/Employee.php';
require __DIR__ . '/src/Repository/EmployeeRepository.php';

$config = require __DIR__ . '/config/config.php';

$database = new Database($config["database"]);

// Comprovar si hi ha un paràmetre d'error a la URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
}

$employeeRepository = new EmployeeRepository($database->getConnection(), Employee::class);
$employees = $employeeRepository->findAll();

echo View::render('employee_list', 'default', ["employees" => $employees]);