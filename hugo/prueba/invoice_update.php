<?php
// Carreguem els arxius i les classes necessàries
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Invoice.php';
require_once __DIR__ . '/src/Repository/InvoiceRepository.php';
require_once __DIR__ . '/src/Entity/Customer.php';
require_once __DIR__ . '/src/Repository/CustomerRepository.php';

// Carreguem la configuració del fitxer config.php
$config = require_once __DIR__ . '/config/config.php';

// Inicialitzem la connexió a la base de dades i els repositoris
$database = new Database($config["database"]);
$invoiceRepository = new InvoiceRepository($database->getConnection(), Invoice::class);
$customerRepository = new CustomerRepository($database->getConnection(), Customer::class);

// Comprovar si hi ha un paràmetre d'error a la URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
}

// Obté l'ID de la factura de la URL
$invoiceId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Verifica si l'ID és vàlid
if ($invoiceId !== false) {
    // Troba la factura per ID
    try {
        $invoiceToUpdate = $invoiceRepository->find($invoiceId);
        $customer = $customerRepository->find($invoiceToUpdate->getCustomerId());
        $invoiceToUpdate->setCustomer($customer);

        if ($invoiceToUpdate !== null) {
            // Renderitza la vista d'actualització de factura
            echo View::render('invoice_update_confirmation', 'backoffice', ["invoiceToUpdate" => $invoiceToUpdate]);
            exit;
        } else {
            // Redirigeix a invoice_list.php amb un missatge d'error si la factura no es troba
            header("Location: /invoice_list.php?error=Factura no trobada");
            exit;
        }
    } catch (\Exception $e) {
        // Gestionar errors al recuperar la factura
        echo "Error al recuperar la factura: " . $e->getMessage();
        exit;
    }
} else {
    // Redirigeix a invoice_list.php amb un missatge d'error si l'ID no és vàlid
    header("Location: /invoice_list.php?error=ID no vàlid");
    exit;
}