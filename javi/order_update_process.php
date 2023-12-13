<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Validator\OrderValidator;
use App\Helper\FlashMessage;
use App\Entity\Login;
use App\Core\Security;

session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

// Carregar la configuració
$config = require_once __DIR__ . '/config/config.php';

// Crear una instància de la base de dades i del repositori de comandes
$database = new Database($config["database"]);
$orderRepository = new OrderRepository($database->getConnection(), Order::class);

// Verificar si s'ha enviat el formulari de confirmació
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtindre l'ID de la comanda a actualitzar
    $idToUpdate = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    // Verificar si l'ID és vàlid abans d'intentar actualitzar
    if ($idToUpdate !== false) {
        // Obtindre la comanda per ID
        $orderToUpdate = $orderRepository->find($idToUpdate);

        // Verificar si s'ha trobat la comanda abans d'intentar actualitzar
        if ($orderToUpdate !== null) {
            $errors = [];
            $validator = new OrderValidator($config);

            // Crear un array amb les dades actualitzades de la comanda
            $newOrderArray = [
                'id' => $idToUpdate,
                'state' => $_POST["state"],
                'customer_id' => $_POST["customer_id"]
            ];

            // Crear una instància de la comanda amb les dades actualitzades
            $newOrder = Order::fromArray($newOrderArray);

            // Validar les dades actualitzades
            $errors = $validator->validate($newOrder);

            if (empty(array_filter($errors))) {
                try {
                    // Actualitzar la comanda a la base de dades
                    $orderRepository->update($newOrder);

                    // Redirigir a order_list.php després de l'actualització
                    header("Location: /order_list.php");
                    exit;
                } catch (Exception $exception) {
                    FlashMessage::set("message", "Error en inserir les dades de la comanda: " . $exception->getMessage());
                    header('Location: order_list.php');
                    exit;
                }
            } else {
                // Redirigir a la pàgina d'actualització amb informació d'error
                $errorMessages = implode(", ", $errors);
                FlashMessage::set("message", $errorMessages);
                header('Location: order_update.php?id=' . $idToUpdate);
                exit;
            }
        } else {
            // Gestionar el cas en què la comanda no es troba
            FlashMessage::set("message", "Comanda no trobada");
            header('Location: order_list.php');
            exit;
        }
    } else {
        // Gestionar el cas en què l'ID no és un enter vàlid
        FlashMessage::set("message", "ID no vàlid");
        header('Location: order_list.php');
        exit;
    }
} else {
    // Si no s'ha enviat el formulari, redirigir a order_list.php
    header("Location: /order_list.php");
    exit;
}