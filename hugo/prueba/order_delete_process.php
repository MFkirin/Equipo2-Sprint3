<?php
require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Order.php';
require_once __DIR__ . '/src/Repository/OrderRepository.php';

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$orderRepository = new OrderRepository($database->getConnection(), Order::class);

// Comprobar si hay un parámetro de error en la URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
    exit;
}

// Verificar si se ha enviado el formulario de confirmación
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID del pedido a eliminar
    $idToDelete = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    // Verificar si el ID es válido antes de intentar eliminar
    if ($idToDelete !== false) {
        // Obtener el pedido por ID
        $orderToDelete = $orderRepository->find($idToDelete);

        // Verificar si se ha encontrado el pedido antes de intentar eliminarlo
        if ($orderToDelete !== null) {
            // Eliminar el pedido
            try {
                // Intentar eliminar el pedido
                $orderRepository->delete($orderToDelete);

                // Redirigir a order_list.php después de la eliminación exitosa
                header("Location: /order_list.php?success=Pedido eliminado correctamente");
                exit;
            } catch (\Exception $exception) {
                // Gestionar la excepción e imprimir el mensaje
                echo "Error al eliminar el pedido: " . $exception->getMessage();
                exit;
            }
        } else {
            // Gestionar el caso en que el pedido no se encuentra
            header("Location: /order_list.php?error=Pedido no encontrado");
            exit;
        }
    } else {
        // Gestionar el caso en que el ID no es un entero válido
        header("Location: /order_list.php?error=ID no válido");
        exit;
    }
} else {
    // Si no se ha enviado el formulario, redirigir a order_list.php
    header("Location: /order_list.php");
    exit;
}