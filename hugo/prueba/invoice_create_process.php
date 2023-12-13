<?php

require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Invoice.php';
require_once __DIR__ . '/src/Repository/InvoiceRepository.php';
require_once __DIR__ . '/src/Validator/InvoiceValidator.php';

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$invoiceRepository = new InvoiceRepository($database->getConnection(), Invoice::class);

// Comprovar si hi ha un paràmetre d'error a la URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    // TODO: Considerar una alternativa a este echo
    echo "Error: $errorMessage";
    exit;
}

// Verificar si s'ha enviat el formulari de confirmació
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errors = [];
    $validator = new InvoiceValidator();

    // Pots validar i processar més camps segons les teues necessitats
    $newInvoiceArray = [
        "id" => 0,
        'number' => (string)$_POST['number'],
        'price' => (float)$_POST['price'],
        'date' => $_POST['date'],
        'customer_id' => (int)$_POST['customer_id'],
        'order_id' => (int)$_POST['order_id'],
    ];

    $newInvoice = Invoice::fromArray($newInvoiceArray);
    $errors = $validator->validate($newInvoice);

    if (empty($errors)) {
        try {
            $invoiceRepository->create($newInvoice);

            // Redirigir a invoice_list.php després de la creació exitosa
            header("Location: /invoice_list.php");
            exit;
        } catch (Exception $exception) {
            // Redirigir a la pàgina de creació amb missatge d'error
            header("Location: /invoice_create.php?error=" . urlencode("Error en inserir les dades de la factura: " . $exception->getMessage()));
            exit;
        }
    } else {
        // Redirigir a la pàgina de creació amb missatges d'error
        $errorMessages = implode(', ', $errors);

        // TODO: Millor usar variables de sessió per a la comunicació entre pàgines (controladors)
        header("Location: /invoice_create.php?error=" . urlencode("Errors de validació: $errorMessages"));
        exit;
    }
} else {
    // Gestionar el cas en què la factura no es troba
    header("Location: /invoice_list.php?error=Factura no trobada");
    exit;
}