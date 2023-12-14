<section>
    <h2>Confirmar Eliminación</h2>
    <?php if (isset($_SESSION["flash-message"]["message"])) {
        echo '<p class="message">' . $_SESSION["flash-message"]["message"] . '</p>';
        FlashMessage::unset("message");
    } ;?>
    <p>¿Estás seguro de que deseas eliminar esta factura?</p>

    <form action="/invoice_delete_process.php" method="post">
        <input type="hidden" name="id" value="<?= $invoiceToDelete->getId(); ?>">
        <table id="invoice-details">
            <tbody>
            <tr>
                <th>ID:</th>
                <td><?= $invoiceToDelete->getId() ?></td>
            </tr>
            <tr>
                <th>Nº Factura:</th>
                <td><?= $invoiceToDelete->getNumber() ?></td>
            </tr>
            <tr>
                <th>Preu:</th>
                <td><?= $invoiceToDelete->getPrice() ?></td>
            </tr>
            <tr>
                <th>Data:</th>
                <td><?= $invoiceToDelete->getDate()->format('Y-m-d') ?></td>
            </tr>
            <tr>
                <th>Client:</th>
                <td><?= $invoiceToDelete->getCustomer() ? $invoiceToDelete->getCustomer()->getName() : "No disponible" ?></td>
            </tr>
            <tr>
                <th>Comanda:</th>
                <td><?= $invoiceToDelete->getOrderId() ?></td>
            </tr>
            </tbody>
        </table>
        <button type="submit">Confirmar Eliminación</button>
    </form>
    <form action="/invoice_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>
