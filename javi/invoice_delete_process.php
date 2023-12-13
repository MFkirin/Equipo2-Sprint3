<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Entity\Invoice;
use App\Repository\InvoiceRepository;
use App\Helper\FlashMessage;
use App\Entity\Login;
use App\Core\Security;

session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$invoiceRepository = new InvoiceRepository($database->getConnection(), Invoice::class);

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
                FlashMessage::set("message", "Factura eliminada correctament");
                header('Location: /invoice_list.php');
                exit;
            } catch (\Exception $exception) {
                // Gestionar l'excepció i imprimir el missatge
                FlashMessage::set("message", "Error al eliminar la factura: " . $exception->getMessage());
                header('Location: /invoice_list.php');
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