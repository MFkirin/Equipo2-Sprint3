<section class="cancel-order-view">
    <h2>Cancelar pedido</h2>
    <?php if (isset($_SESSION["flash-message"]["message"])) {
        echo '<p class="message">' . $_SESSION["flash-message"]["message"] . '</p>';
        FlashMessage::unset("message");
    }; ?>
    <p>¿Estás seguro de que deseas cancelar este pedido?</p>

    <form action="/order_vehicle_cancelled_process.php" method="post">
        <input type="hidden" name="order_id" value="<?= $order->getId(); ?>">
        <table class="order-details-table">
            <tbody>
            <tr>
                <th>Estado:</th>
                <td><?= $order->getState() ?></td>
            </tr>
            <tr>
                <th>Nombre del cliente:</th>
                <td><?= $order->getCustomer() ? $order->getCustomer()->getName() . " " . $order->getCustomer()->getLastName() : "No disponible" ?></td>
            </tr>
            <tr>
                <th>Total:</th>
                <td><?= $order->getTotalPrice() ?> €</td>
            </tr>
            </tbody>
        </table>
        <div class="button-group">
            <button type="submit" class="confirm-button">Confirmar</button>
            <a href="/garage_list.php" class="cancel-button">Cancelar</a>
        </div>
    </form>
</section>
