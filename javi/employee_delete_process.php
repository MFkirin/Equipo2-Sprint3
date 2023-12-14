<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Entity\Employee;
use App\Repository\EmployeeRepository;

$config = require __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$employeeRepository = new EmployeeRepository($database->getConnection(), Employee::class);

if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtindre l'ID del login a eliminar
    $idToDelete = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    // Verificar si l'ID és vàlid abans d'intentar eliminar
    if ($idToDelete !== false) {
        // Obtindre el login per ID
        $employeeToDelete = $employeeRepository->find($idToDelete);

        // Verificar si s'ha trobat el login abans d'intentar eliminar-lo
        if ($employeeToDelete !== null) {
            // Eliminar el login
            $employeeRepository->delete($employeeToDelete);

            // Redirigir a login_list.php després de l'eliminació
            header("Location: /employee_list.php");
            exit;
        } else {
            // Gestionar el cas en què el login no es troba
            header("Location: /employee_list.php?error=Login no trobat");
            exit;
        }
    } else {
        // Gestionar el cas en què l'ID no és un enter vàlid
        header("Location: /employee_list.php?error=ID no vàlid");
        exit;
    }
} else {
    // Si no s'ha enviat el formulari, redirigir a login_list.php
    header("Location: /employee_list.php");
    exit;
}