<?php
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Invoice.php';
require_once __DIR__ . '/src/Repository/InvoiceRepository.php';

$config = require_once __DIR__ . '/config/config.php';

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
    // Obtindre l'ID del login a eliminar
    $idToDelete = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    // Verificar si l'ID és vàlid abans d'intentar eliminar
    if ($idToDelete !== false) {
        // Obtindre la factura per ID
        $invoiceToDelete = $invoiceRepository->find($idToDelete);

        // Verificar si s'ha trobat la factura abans d'intentar eliminar-la
        if ($invoiceToDelete !== null) {
            // Eliminar la factura
            try {
                // Intentar eliminar la factura
                $invoiceRepository->delete($invoiceToDelete);

                // Redirigir a invoice_list.php després de l'eliminació exitosa
                header("Location: /invoice_list.php?success=Factura eliminada correctament");
                exit;
            } catch (\Exception $exception) {
                // Gestionar l'excepció i imprimir el missatge
                echo "Error al eliminar la factura: " . $exception->getMessage();
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