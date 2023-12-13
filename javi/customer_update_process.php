<?php
declare(strict_types=1);
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Customer.php';
require_once __DIR__ . '/src/Repository/CustomerRepository.php';
require_once __DIR__ . '/src/Validator/CustomerValidator.php';

$config = require __DIR__ . '/config/config.php';

// Comprovar si hi ha un paràmetre d'error a la URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
    exit;
}

// Verificar si s'ha enviat el formulari de confirmació
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $database = new Database($config["database"]);
    $customerRepository = new CustomerRepository($database->getConnection(), Customer::class);


    // Obtindre l'ID del login a editar
    $idToUpdate = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    // Verificar si l'ID és vàlid abans d'intentar editar
    if ($idToUpdate !== false) {

        // Obtindre el login per ID
        $customerToUpdate = $customerRepository->find($idToUpdate);


        // Verificar si s'ha trobat el login abans d'intentar editar
        if ($customerToUpdate !== null) {

            $errors = [];
            $validator = new CustomerValidator();

            $newCustomerArray = [
                "id" => $idToUpdate ?? 0,
                'name' => $_POST['name'] ?? "",
                'lastname' => $_POST['lastname'] ?? "",
                'address' => $_POST['address'] ?? "",
                'dni' => $_POST['dni'] ?? "",
                'phone' => $_POST['phone'] ?? "",
                'bussiness_name' => $_POST['bussiness_name'] ?? "",
                'email' => $_POST['email'] ?? "",
                'login_id' => $idToUpdate ?? 0,
            ];

            var_dump($newCustomerArray);

            $newCustomer = Customer::fromArray($newCustomerArray);
            $errors = $validator->validate($newCustomer);

            if (empty($errors)) {
                try {
                    $customerRepository->update($newCustomer);

                    // Redirigir a customer_list.php després de l'edició
                    header("Location: /customer_list.php");
                    exit;
                } catch (Exception $exception) {
                    echo "Error en inserir les dades del proveïdor: " . $exception->getMessage();
                }
            } else {
                var_dump($loginToUpdate);
                var_dump($errors);
            }
        } else {
            // Gestionar el cas en què el client no es troba
            header("Location: /customer_list.php?error=Client no trobat");
            exit;
        }
    } else {
        // Gestionar el cas en què l'ID no és un enter vàlid
        header("Location: /customer_list.php?error=ID no vàlid");
        exit;
    }
} else {
    // Si no s'ha enviat el formulari, redirigir a customer_list.php
    header("Location: /customer_list.php");
    exit;
}