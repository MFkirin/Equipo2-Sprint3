<?php
declare(strict_types=1);

use App\Core\Database;
use App\Core\View;
use App\Entity\Customer;
use App\Exception\RecordNotFoundException;
use App\Repository\CustomerRepository;

require_once __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$customerRepository = new CustomerRepository($database->getConnection(), Customer::class);

// Obtindre l'ID del login des de la URL
$idToDelete = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Verificar si l'ID és vàlid abans d'intentar eliminar
if ($idToDelete !== false) {
    // Obtindre el login per ID
    try {
        $customerToDelete = $customerRepository->find($idToDelete);
    } catch (RecordNotFoundException $e) {
    }

    // Verificar si s'ha trobat el login abans de mostrar la vista de confirmació
    if ($customerToDelete !== null) {
        echo View::render('customer_delete_confirmation', 'default', ["customerToDelete" => $customerToDelete]);
    } else {
        // Gestionar el cas en què el login no es troba
        header("Location: /customer_list.php?error=Customer no trobat");
        exit;
    }
} else {
    // Gestionar el cas en què l'ID no és un enter vàlid
    header("Location: /customer_list.php?error=ID no vàlid");
    exit;
}