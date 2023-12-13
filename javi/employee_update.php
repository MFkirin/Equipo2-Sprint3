<?php
require __DIR__ . '/src/Core/Database.php';
require __DIR__ . '/src/Core/View.php';
require __DIR__ . '/src/Entity/Employee.php';
require __DIR__ . '/src/Repository/EmployeeRepository.php';

$config = require __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$employeeRepository = new EmployeeRepository($database->getConnection(), Employee::class);

// Obtindre l'ID del login des de la URL
$idToUpdate = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$errors = [];

// Verificar si l'ID és vàlid abans d'intentar editar
if (!empty($idToUpdate)) {
    // Obtindre el login per ID
    try {
        $employeeToUpdate = $employeeRepository->find($idToUpdate);
    } catch (Exception $e ) {
        $errors[] = $e->getMessage();
    }

    // Verificar si s'ha trobat el login abans de mostrar la vista de confirmació
    if (empty($errors)) {
        echo View::render('employee_update_confirmation', 'default', ["employeeToUpdate" => $employeeToUpdate]);
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