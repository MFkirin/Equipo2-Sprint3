<section>
    <h2>Inicis de sessió</h2>
    <?php use App\Helper\FlashMessage;

    if (isset($_SESSION["flash-message"]["message"])) {
        echo '<p class="message">' . $_SESSION["flash-message"]["message"] . '</p>';
        FlashMessage::unset("message");
    } ;?>
    <a href="/vehicle_create.php">
        <button type="button" class="create-login-button">Insertar nou Vehicle</button>
    </a>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Plate</th>
            <th>Danys observats</th>
            <th>Kilometres</th>
            <th>Buy Price</th>
            <th>Sell Price</th>
            <th>Fuel</th>
            <th colspan="2">Operacions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($vehicles as $vehicle): ?>
            <tr>
                <td><?= $vehicle->getId() ?></td>
                <td><?= $vehicle->getPlate() ?></td>
                <td><?= $vehicle->getObservedDamages() ?></td>
                <td><?= $vehicle->getKilometers() ?></td>
                <td><?= $vehicle->getBuyPrice() ?></td>
                <td><?= $vehicle->getSellPrice() ?></td>
                <td><?= $vehicle->getFuel() ?></td>
                <td><a href="/vehicle_update.php?id=<?= $vehicle->getId(); ?>" class="operation-link edit-link">Editar</a>
                </td>
                <td><a href="/vehicle_delete.php?id=<?= $vehicle->getId(); ?>"
                       class="operation-link delete-link">Eliminar</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</section>
