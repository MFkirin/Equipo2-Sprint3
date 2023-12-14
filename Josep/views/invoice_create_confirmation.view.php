<section>
    <h2>Creación de factura</h2>
    <?php if (isset($_SESSION["flash-message"]["message"])) {
        echo '<p class="message">' . $_SESSION["flash-message"]["message"] . '</p>';
        FlashMessage::unset("message");
    } ;?>
    <form action="/invoice_create_process.php" method="post">

        <label for="number">Número de factura:</label>
        <input type="text" id="number" name="number" required minlength="5" maxlength="20" pattern="[A-Za-z0-9-]+"
               title="Solo se permiten caracteres alfanuméricos y guiones" placeholder="1234A">

        <label for="price">Precio:</label>
        <input type="number" id="price" name="price" step="0.01" required min="0.01"
               title="El precio debe ser mayor que cero" placeholder="8500.00">

        <label for="date">Fecha:</label>
        <input type="date" id="date" name="date" required>

        <label for="customer_id">ID del Cliente:</label>
        <input type="number" id="customer_id" name="customer_id" required min="1">

        <label for="order_id">ID del Pedido:</label>
        <input type="number" id="order_id" name="order_id" required min="1">
        <button type="submit">Crear</button>
    </form>

    <form action="/invoice_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>