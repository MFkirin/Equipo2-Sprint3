<section>
    <h2>Confirmar actualitzación de Factura</h2>
    <?php use App\Helper\FlashMessage;

    if (isset($_SESSION["flash-message"]["message"])) {
        echo '<p class="message">' . $_SESSION["flash-message"]["message"] . '</p>';
        FlashMessage::unset("message");
    }; ?>
    <form action="/invoice_update_process.php" method="post">
        <!-- Inclou l'ID de la factura a actualitzar com a un camp ocult -->
        <input type="hidden" name="id" value="<?= $invoiceToUpdate->getId(); ?>">

        <!-- Afegir camps per editar la informació de la factura -->
        <label for="number">Número de factura:</label>
        <input type="text" id="number" name="number"
               value="<?= isset($_POST['number']) ? htmlspecialchars($_POST['number']) : $invoiceToUpdate->getNumber(); ?>"
               required minlength="5" maxlength="20" pattern="[A-Za-z0-9-]+"
               title="Només es permeten caràcters alfanumèrics i guions" placeholder="1234A">

        <label for="price">Precio:</label>
        <input type="number" id="price" name="price"
               value="<?= isset($_POST['price']) ? htmlspecialchars($_POST['price']) : $invoiceToUpdate->getPrice(); ?>"
               step="0.01" required min="0.01" title="El preu ha de ser major que zero" placeholder="8500.00">

        <label for="date">Fecha:</label>
        <input type="date" id="date" name="date"
               value="<?= isset($_POST['date']) ? htmlspecialchars($_POST['date']) : $invoiceToUpdate->getDate()->format('Y-m-d'); ?>"
               required>

        <label for="customer_id">ID del Cliente:</label>
        <input type="number" id="customer_id" name="customer_id" required min="1"
               value="<?= isset($_POST['customer_id']) ? htmlspecialchars($_POST['customer_id']) : $invoiceToUpdate->getCustomerId(); ?>">

        <label for="order_id">ID de la Comanda:</label>
        <input type="number" id="order_id" name="order_id"
               value="<?= isset($_POST['order_id']) ? htmlspecialchars($_POST['order_id']) : $invoiceToUpdate->getOrderId(); ?>"
               required min="1">

        <button type="submit">Actualizar Factura</button>
    </form>

    <form action="/invoice_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>