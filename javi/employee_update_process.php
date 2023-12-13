<?php
require __DIR__ . '/src/Core/Database.php';
require __DIR__ . '/src/Core/View.php';
require __DIR__ . '/src/Entity/Employee.php';
require __DIR__ . '/src/Repository/EmployeeRepository.php';
require __DIR__ . '/src/Validator/EmployeeValidator.php';

$config = require __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$employeeRepository = new EmployeeRepository($database->getConnection(), Employee::class);

// Comprovar si hi ha un paràmetre d'error a la URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
    exit;
}

// Verificar si s'ha enviat el formulari de confirmació
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtindre l'ID del login a editar
    $idToUpdate = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    // Verificar si l'ID és vàlid abans d'intentar editar
    if ($idToUpdate !== false) {
        // Obtindre el login per ID
        $employeeToUpdate = $employeeRepository->find($idToUpdate);

        // Verificar si s'ha trobat el login abans d'intentar editar
        if ($employeeToUpdate !== null) {
            //$errors = [];
            $validator = new EmployeeValidator();
            $validator->setValidRoles($config["roles"]);


            /* $username = $_POST["username"] ?? "";
             $loginToUpdate->setUsername($username);*/

            $newEmployeeArray = [
                'id' => $idToUpdate,
                'name' => $_POST['name'] ?? "",
                'lastname' => $_POST['lastname'] ?? "",
                'type' => $_POST['type'] ?? "",
            ];
            $newEmployee = Employee::fromArray($newEmployeeArray);


            $errors = $validator->validate($newEmployee);

            if (empty($errors)) {
                try {
                    $employeeRepository->update($newEmployee);

                    // Redirigir a login_list.php després de l'edició
                    header("Location: /employee_list.php");
                    exit;
                } catch (Exception $exception) {
                    echo "Error en inserir les dades del proveïdor: " . $exception->getMessage();
                }
            } else {
                var_dump($employeeToUpdate);
                var_dump($errors);
            }
        } else {
            // Gestionar el cas en què el login no es troba
            header("Location: /employee_list.php?error=Employee no trobat");
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