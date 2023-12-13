<section>
    <h2>Confirmar Eliminación</h2>

    <p>¿Estás seguro de que deseas eliminar este pedido?</p>

    <form action="/order_delete_process.php" method="post">
        <input type="hidden" name="id" value="<?= $orderToDelete->getId(); ?>">
        <table id="order-details">
            <tbody>
            <tr>
                <th>ID:</th>
                <td><?= $orderToDelete->getId() ?></td>
            </tr>
            <tr>
                <th>Estado:</th>
                <td><?= $orderToDelete->getState() ?></td>
            </tr>
            <tr>
                <th>Cliente:</th>
                <td><?= $orderToDelete->getCustomer() ? $orderToDelete->getCustomer()->getName() : "No disponible" ?></td>
            </tr>
            <tr>
                <th>Total:</th>
                <td><?= $orderToDelete->getTotalPrice() ?></td>
            </tr>
            </tbody>
        </table>
        <button type="submit">Confirmar Eliminación</button>
    </form>
    <form action="/order_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>