<section>
    <h2>Inicis de sessió</h2>
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
        <div class="contenedor-flex">

            <div class="item">
                <div class="item-top">
                    <img src="<?php $img->getFilename() ?>" alt="McLaren Solus GT">

                </div>
                <div class="item-bottom">
                    <h3>McLaren</h3>
                    <div class="item-text">
                        <span>Solus GT</span>
                        <span style="float: right;"><?= $vehicle->getFuel() ?></span>
                    </div>
                    <div class="item-text">
                        <span><?= $vehicle->getPlate() ?></span>
                        <span><?= $vehicle->getRegistrationDate()->format('Y') ?></span>
                        <span><?= $vehicle->getKilometers() ?>km</span>
                    </div>
                    <div id="editar"><a href="/vehicle_update.php?id=<?= $vehicle->getId(); ?>"><img src="/assets/img/editar.png" /></a></div>
                </div>
            </div>
        </div>
            <tr>
                <td><?= $vehicle->getPlate() ?></td>
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
