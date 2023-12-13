<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Helper\FlashMessage;
use App\Entity\Login;
use App\Core\Security;

session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$orderRepository = new OrderRepository($database->getConnection(), Order::class);

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
                FlashMessage::set("message", "Error al eliminar el pedido: " . $exception->getMessage());
                header('Location: order_list.php');
                exit;
            }
        } else {
            // Gestionar el caso en que el pedido no se encuentra
            FlashMessage::set("message", "Pedido no encontrado");
            header('Location: order_list.php');
            exit;
        }
    } else {
        // Gestionar el caso en que el ID no es un entero válido
        FlashMessage::set("message", "ID no válido");
        header('Location: order_list.php');
        exit;
    }
} else {
    // Si no se ha enviado el formulario, redirigir a order_list.php
    header("Location: /order_list.php");
}