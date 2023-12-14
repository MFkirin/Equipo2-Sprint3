<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Core\View;
use App\Entity\Employee;
use App\Repository\EmployeeRepository;

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