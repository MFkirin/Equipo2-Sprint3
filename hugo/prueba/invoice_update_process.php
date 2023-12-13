<?php
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Invoice.php';
require_once __DIR__ . '/src/Repository/InvoiceRepository.php';
require_once __DIR__ . '/src/Validator/InvoiceValidator.php';

// Carregar la configuració
$config = require_once __DIR__ . '/config/config.php';

// Crear una instància de la base de dades i del repositori de factures
$database = new Database($config["database"]);
$invoiceRepository = new InvoiceRepository($database->getConnection(), Invoice::class);

// Comprovar si hi ha un paràmetre d'error a la URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
    exit;
}

// Verificar si s'ha enviat el formulari de confirmació
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtindre l'ID de la factura a actualitzar
    $idToUpdate = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    // Verificar si l'ID és vàlid abans d'intentar actualitzar
    if ($idToUpdate !== false) {
        // Obtindre la factura per ID
        $invoiceToUpdate = $invoiceRepository->find($idToUpdate);

        // Verificar si s'ha trobat la factura abans d'intentar actualitzar
        if ($invoiceToUpdate !== null) {
            $errors = [];
            $validator = new InvoiceValidator();

            // Crear un array amb les dades actualitzades de la factura
            $newInvoiceArray = [
                'id' => $idToUpdate,
                'number' => $_POST['number'],
                'price' => $_POST['price'],
                'date' => $_POST['date'],
                'customer_id' => $_POST['customer_id'],
                'order_id' => $_POST['order_id'],
            ];

            // Crear una instància de la factura amb les dades actualitzades
            $newInvoice = Invoice::fromArray($newInvoiceArray);

            // Validar les dades actualitzades
            $errors = $validator->validate($newInvoice);

            if (empty(array_filter($errors))) {
                try {
                    // Actualitzar la factura a la base de dades
                    $invoiceRepository->update($newInvoice);

                    // Redirigir a invoice_list.php després de l'actualització
                    header("Location: /invoice_list.php");
                    exit;
                } catch (Exception $exception) {
                    echo "Error en inserir les dades de la factura: " . $exception->getMessage();
                }
            } else {
                // Redirigir a la pàgina d'actualització amb informació d'error
                $errorMessages = implode(", ", $errors);
                header("Location: /invoice_update.php?id=$idToUpdate&error=$errorMessages");
                exit;
            }
        } else {
            // Gestionar el cas en què la factura no es troba
            header("Location: /invoice_list.php?error=Factura no trobada");
            exit;
        }
    } else {
        // Gestionar el cas en què l'ID no és un enter vàlid
        header("Location: /invoice_list.php?error=ID no vàlid");
        exit;
    }
} else {
    // Si no s'ha enviat el formulari, redirigir a invoice_list.php
    header("Location: /invoice_list.php");
    exit;
}