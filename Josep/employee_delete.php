<?php
require __DIR__ . '/src/Core/Database.php';
require __DIR__ . '/src/Core/View.php';
require __DIR__ . '/src/Entity/Employee.php';
require __DIR__ . '/src/Repository/EmployeeRepository.php';

$config = require __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$employeeRepository = new EmployeeRepository($database->getConnection(), Employee::class);

// Obtindre l'ID del login des de la URL
$idToDelete = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Verificar si l'ID és vàlid abans d'intentar eliminar
if ($idToDelete !== false) {
    // Obtindre el login per ID
    try {
        $employeeToDelete = $employeeRepository->find($idToDelete);
    } catch (RecordNotFoundException $e) {
        // Gestionar el caso en que el empleado no se encuentra
        header("Location: /employee_list.php?error=Employee no trobat");
        exit;
    }

    // Verificar si s'ha trobat el login abans de mostrar la vista de confirmació
    if ($employeeToDelete !== null) {
        echo View::render('employee_delete_confirmation', 'default', ["employeeToDelete" => $employeeToDelete]);
        exit; // Importante salir después de renderizar la vista.
    } else {
        // Gestionar el caso en que el empleado no se encuentra
        header("Location: /employee_list.php?error=Employee no trobat");
        exit;
    }
} else {
    // Gestionar el caso en que l'ID no és un enter vàlid
    header("Location: /employee_list.php?error=ID no vàlid");
    exit;
}
