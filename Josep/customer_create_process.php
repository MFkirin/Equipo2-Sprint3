<?php

require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Customer.php';
require_once __DIR__ . '/src/Repository/CustomerRepository.php';
require_once __DIR__ . '/src/Validator/CustomerValidator.php';
require_once __DIR__ . '/src/Entity/Login.php';
require_once __DIR__ . '/src/Repository/LoginRepository.php';
require_once __DIR__ . '/src/Validator/LoginValidator.php';

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

    $database = new Database($config["database"]);
    $customerRepository = new CustomerRepository($database->getConnection(), Customer::class);

    $loginRepository = new LoginRepository($database->getConnection(), Login::class);

    $validator = new CustomerValidator();

    $newCustomerArray = [
        "id" => 0 ?? "",
        'name' => $_POST['name'] ?? "",
        'lastname' => $_POST['lastname'] ?? "",
        'address' => $_POST['address'] ?? "",
        'dni' => $_POST['dni'] ?? "",
        'phone' => $_POST['phone'] ?? "",
        'bussiness_name' => $_POST['bussiness_name'] ?? "",
        'email' => $_POST['email'] ?? "",
        'login_id' => 0 ?? "",
    ];

    $newCustomer = Customer::fromArray($newCustomerArray);
    $errors = $validator->validate($newCustomer);

    $newLoginArray = [
        "id" => 0,
        "username" => $_POST["username"] ?? "",
        "password" => $_POST["password"] ?? "",
        "role" => "professional"
    ];

    $newLogin = Login::fromArray($newLoginArray);
    $loginValidator = new LoginValidator();
    $errorsLogin = $loginValidator->validate($newLogin);

    $errors = array_merge($errors, $errorsLogin);    $errors = [];


    if (empty($errors)) {
        try {

            $database->getConnection()->beginTransaction();

            $loginRepository->create($newLogin);

            $newCustomer->setLoginId($newLogin->getId());

            $customerRepository->create($newCustomer);

            $database->getConnection()->commit();

            // Redirigir a login_list.php després de la creació exitosa
            header("Location: /customer_list.php");
            exit;
        } catch (Exception $exception) {
            // Redirigir a la pàgina de creació amb missatge d'error
            $database->getConnection()->rollBack();
            //die($exception->getMessage());
            header("Location: /customer_create.php?error=" . urlencode("Error en insertar les dades del proveïdor: " . $exception->getMessage()));
            exit;
        }
    } else {
        // Redirigir a la pàgina de creació amb missatges d'error
        $errorMessages = implode(', ', $errors);

        // TODO: millor usar variables de sessió per a la comunicació entre pàgines (controladors)
        header("Location: /customer_create.php?error=" . urlencode("Errors de validació: $errorMessages"));
        exit;
    }
} else {
    // Gestionar el cas en què el login no es troba
    header("Location: /customer_list.php?error=Login no trobat");
    exit;
}