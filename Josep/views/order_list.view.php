<section>
    <h1>Lista de Pedidos</h1>
    <hr>
    <?php if (isset($_SESSION["flash-message"]["message"])) {
        echo '<p class="message">' . $_SESSION["flash-message"]["message"] . '</p>';
        FlashMessage::unset("message");
    } ;?>
    <input type="text" id="inputUsuario" placeholder="Buscador">
    <table id="table">
        <thead>
        <th>ID</th>
        <th>Usuario</th>
        <th>Vehículos</th>
        <th>Estado</th>
        <th>Total</th>
        <th>Operaciones</th>
        </thead>
        <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td data-titulo="Id:"><?= $order->getId(); ?></td>
                <td data-titulo="Nombre:"><?= $order->getCustomer()->getName(); ?></td>
                <td data-titulo="Vehiculo:"><?= count($order->getVehicles()) ?></td>
                <td data-titulo="Estado:"><?= $order->getState(); ?></td>
                <td data-titulo="Precio:"><?= $order->getTotalPrice() ?>
                </td>
                <td>
                    <a href="/order_detail.php?id=<?= $order->getId() ?>">
                        <button>Ver detalles</button>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</section>