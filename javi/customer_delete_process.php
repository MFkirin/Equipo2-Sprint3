<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

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

    // Obtindre l'ID del login a eliminar
    $idToDelete = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    var_dump($idToDelete);
    // Verificar si l'ID és vàlid abans d'intentar eliminar
    if ($idToDelete !== false) {
        // Obtindre el login per ID
        $customerToDelete = $customerRepository->find($idToDelete);

        // Verificar si s'ha trobat el customer abans d'intentar eliminar-lo
        if ($customerToDelete !== null) {
            // Eliminar el login
            $customerRepository->delete($customerToDelete);

            // Redirigir a customer_list.php després de l'eliminació
            var_dump('eliminat');
            header("Location: /customer_list.php");
            exit;
        } else {
            // Gestionar el cas en què el customer no es troba
            header("Location: /customer_list.php?error=Customer no trobat");
            exit;
        }
    } else {
        // Gestionar el cas en què l'ID no és un enter vàlid
        header("Location: /customer_list.php?error=ID no vàlid");
        exit;
    }
} else {
    var_dump('eliminat');
    // Si no s'ha enviat el formulari, redirigir a customer_list.php
    header("Location: /customer_list.php");
    exit;
}