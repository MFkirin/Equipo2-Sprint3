<?php
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Entity/Order.php';
require_once __DIR__ . '/src/Repository/OrderRepository.php';
require_once __DIR__ . '/src/Validator/OrderValidator.php';

// Carregar la configuració
$config = require_once __DIR__ . '/config/config.php';

// Crear una instància de la base de dades i del repositori de comandes
$database = new Database($config["database"]);
$orderRepository = new OrderRepository($database->getConnection(), Order::class);

// Comprovar si hi ha un paràmetre d'error a la URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
    exit;
}

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
                    echo "Error en inserir les dades de la comanda: " . $exception->getMessage();
                }
            } else {
                // Redirigir a la pàgina d'actualització amb informació d'error
                $errorMessages = implode(", ", $errors);
                header("Location: /order_update.php?id=$idToUpdate&error=$errorMessages");
                exit;
            }
        } else {
            // Gestionar el cas en què la comanda no es troba
            header("Location: /order_list.php?error=Comanda no trobada");
            exit;
        }
    } else {
        // Gestionar el cas en què l'ID no és un enter vàlid
        header("Location: /order_list.php?error=ID no vàlid");
        exit;
    }
} else {
    // Si no s'ha enviat el formulari, redirigir a order_list.php
    header("Location: /order_list.php");
    exit;
}