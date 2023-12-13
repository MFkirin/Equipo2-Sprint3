<section>
    <h2>Actualización de Pedido</h2>
    <?php use App\Helper\FlashMessage;

    if (isset($_SESSION["flash-message"]["message"])) {
        echo '<p class="message">' . $_SESSION["flash-message"]["message"] . '</p>';
        FlashMessage::unset("message");
    } ;?>
    <form action="/order_update_process.php" method="post">
        <input type="hidden" name="id" value="<?= $orderToUpdate->getId(); ?>">

        <select id="state" name="state" required>
            <option value="pending" <?= ($orderToUpdate->getState() === 'pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="processing" <?= ($orderToUpdate->getState() === 'processing') ? 'selected' : ''; ?>>Processing</option>
            <option value="completed" <?= ($orderToUpdate->getState() === 'completed') ? 'selected' : ''; ?>>Completed</option>
            <option value="cancelled" <?= ($orderToUpdate->getState() === 'cancelled') ? 'selected' : ''; ?>>Cancelled</option>
            <option value="payed" <?= ($orderToUpdate->getState() === 'payed') ? 'selected' : ''; ?>>Payed</option>
            <option value="delivered" <?= ($orderToUpdate->getState() === 'delivered') ? 'selected' : ''; ?>>Delivered</option>
            <option value="shipped" <?= ($orderToUpdate->getState() === 'shipped') ? 'selected' : ''; ?>>Shipped</option>
        </select>

        <label for="customer_id">ID del Cliente:</label>
        <input type="number" id="customer_id" name="customer_id" required min="1"
               value="<?= isset($_POST['customer_id']) ? htmlspecialchars($_POST['customer_id']) : $orderToUpdate->getCustomerId(); ?>">

        <button type="submit">Actualizar</button>
    </form>

    <form action="/order_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>
