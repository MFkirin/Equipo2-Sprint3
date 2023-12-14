<?php

require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Login.php';
require_once __DIR__ . '/src/Repository/LoginRepository.php';
require_once __DIR__ . '/src/Validator/LoginValidator.php';
require_once __DIR__ . '/src/Entity/Employee.php';
require_once __DIR__ . '/src/Repository/EmployeeRepository.php';
require_once __DIR__ . '/src/Validator/EmployeeValidator.php';

$config = require __DIR__ . '/config/config.php';

// Comprovar si hi ha un paràmetre d'error a la URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    // TODO: Cal buscar una alternativa a aquest echo
    echo "Error: $errorMessage";
    exit;
}

// Verificar si s'ha enviat el formulari de confirmació
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roles = $config['roles'];
    $database = new Database($config["database"]);
    $employeeRepository = new EmployeeRepository($database->getConnection(), Employee::class);
    $loginRepository = new LoginRepository($database->getConnection(), Login::class);

    $validator = new EmployeeValidator();

    $newEmployeeArray = [
        'id' => 0 ?? '',
        'name' => $_POST['name'] ?? "",
        'lastname' => $_POST['lastname'] ?? "",
        'type' => $_POST['type'] ?? "",
        'login_id' => 0 ?? "",
    ];

    $newEmployee = Employee::fromArray($newEmployeeArray);
    $errorsEmployee = $validator->validate($newEmployee);

    $newLoginArray = [
        "id" => 0,
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'role' => $_POST['type']
    ];
    // var_dump($newLoginArray);
    $newLogin = Login::fromArray($newLoginArray);
    $employeeLoginValidator = new LoginValidator($roles);
    $errorsLogin = $employeeLoginValidator->validate($newLogin);

    if (empty($errorsEmployee) && (empty($errorsLogin))) {
        try {
            $database->getConnection()->beginTransaction();
            $loginRepository->create($newLogin);
            $newEmployee->setLoginId($newLogin->getId());

            var_dump($newLogin);
            $employeeRepository->create($newEmployee);
            $database->getConnection()->commit();

            // Redirigir a login_list.php després de la creació exitosa
            header("Location: /employee_list.php");
            exit;
        } catch (Exception $exception) {
            $database->getConnection()->rollBack();
            // Redirigir a la pàgina de creació amb missatge d'error
            header("Location: /employee_create.php?error=" . urlencode("Error en insertar les dades: " . $exception->getMessage()));
            exit;
        }
    } else {
        // Redirigir a la pàgina de creació amb missatges d'error
        $errorMessages = implode(', ', array_merge($errorsEmployee, $errorsLogin));
        // TODO: millor usar variables de sessió per a la comunicació entre pàgines (controladors)
        header("Location: /employee_create.php?error=" . urlencode("Errors de validació: $errorMessages"));
        exit;
    }
} else {
    // Gestionar el cas en què el login no es troba
    header("Location: /employee_list.php?error=Login no trobat");
    exit;
}