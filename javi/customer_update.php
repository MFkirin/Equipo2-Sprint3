<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Core\View;
use App\Entity\Customer;
use App\Exception\RecordNotFoundException;
use App\Repository\CustomerRepository;

$config = require __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$customerRepository = new CustomerRepository($database->getConnection(), Customer::class);

// Comprovar si hi ha un paràmetre d'error a la URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
    exit;
}

// Obtindre l'ID del customer des de la URL
$idToUpdate = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Verificar si l'ID és vàlid abans d'intentar editar
if ($idToUpdate !== false) {
    // Obtindre el customer per ID
    try {
        $customerToUpdate = $customerRepository->find($idToUpdate);
    } catch (RecordNotFoundException $e) {
    }

    // Verificar si s'ha trobat el customer abans de mostrar la vista de confirmació
    if ($customerToUpdate !== null) {
        echo View::render('customer_update_confirmation', 'default', ["customerToUpdate" => $customerToUpdate]);
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