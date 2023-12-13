<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Entity\Invoice;
use App\Repository\InvoiceRepository;
use App\Validator\InvoiceValidator;
use App\Helper\FlashMessage;
use App\Entity\Login;
use App\Core\Security;

session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

// Carregar la configuració
$config = require_once __DIR__ . '/config/config.php';

// Crear una instància de la base de dades i del repositori de factures
$database = new Database($config["database"]);
$invoiceRepository = new InvoiceRepository($database->getConnection(), Invoice::class);

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
                    FlashMessage::set("message", "Factura actualitzada correctament");
                    header('Location: /invoice_list.php');
                    exit;
                } catch (Exception $exception) {
                    FlashMessage::set("message", "Error en inserir les dades de la factura: " . $exception->getMessage());
                    header('Location: /invoice_list.php');
                    exit;
                }
            } else {
                // Redirigir a la pàgina d'actualització amb informació d'error
                $errorMessages = implode(", ", $errors);
                FlashMessage::set("message", $errorMessages);
                header('Location: /invoice_update.php?id=' . $idToUpdate);
                exit;
            }
        } else {
            // Gestionar el cas en què la factura no es troba
            FlashMessage::set("message", "Factura no trobada");
            header('Location: /invoice_list.php');
            exit;
        }
    } else {
        // Gestionar el cas en què l'ID no és un enter vàlid
        FlashMessage::set("message", "ID no vàlid");
        header('Location: /invoice_list.php');
        exit;
    }
} else {
    // Si no s'ha enviat el formulari, redirigir a invoice_list.php
    header("Location: /invoice_list.php");
    exit;
}