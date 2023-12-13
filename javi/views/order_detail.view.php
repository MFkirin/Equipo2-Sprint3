
<section class="row">
    <section class="col-10">
        <h1>Detalles del Pedido</h1>
        <?php use App\Helper\FlashMessage;

        if (isset($_SESSION["flash-message"]["message"])) {
            echo '<p class="message">' . $_SESSION["flash-message"]["message"] . '</p>';
            FlashMessage::unset("message");
        } ;?>
        <?php if (isset($order)): ?>
            <table id="order-details">
                <tbody>
                <tr>
                    <th>ID:</th>
                    <td><?= $order->getId() ?></td>
                </tr>
                <tr>
                    <th>Estado:</th>
                    <td><?= $order->getState() ?></td>
                </tr>
                <tr>
                    <th>Cliente:</th>
                    <td><?= $order->getCustomer() ? $order->getCustomer()->getName() : "No disponible" ?></td>
                </tr>
                <tr>
                    <th>Total:</th>
                    <td><?= $order->getTotalPrice() ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <a href="/order_list.php">
                            <button>Volver a la lista de pedidos</button>
                        </a>
                        <a href="/order_update.php?id=<?= $order->getId() ?>">
                            <button>Actualizar Pedido</button>
                        </a>
                        <a href="/order_delete.php?id=<?= $order->getId() ?>">
                            <button>Borrar Pedido</button>
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        <?php else: ?>
            <p>Pedido no encontrado</p>
        <?php endif; ?>
    </section>
</section>
