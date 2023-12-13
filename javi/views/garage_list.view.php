<section id="garage-section" class="section-order-preview">
    <a href="/catalogue_list.php" class="back-button">
        <button>Volver al catálogo</button>
    </a>
    <h1 class="title">Garaje
        de <?= $activeOrder->getCustomer()->getName() . " " . $activeOrder->getCustomer()->getLastName() ?></h1>
    <hr>
    <?php use App\Helper\FlashMessage;

    if (isset($_SESSION["flash-message"]["message"])): ?>
        <p class="message"><?= $_SESSION["flash-message"]["message"] ?></p>
        <?php FlashMessage::unset("message"); ?>
    <?php endif; ?>

    <div class="vehicle-grid">
        <?php foreach ($vehicles as $vehicle): ?>
            <div class="vehicle-card">
                <?php if (!empty($vehicle->getImages())): ?>
                    <img src="../assets/img/vehicles/<?= $vehicle->getImages()[0]->getFilename() ?>"
                         class="vehicle-image" alt="<?= $vehicle->getImages()[0]->getFilename() ?>">
                <?php else: ?>
                    <img src="../assets/img/vehicles/ford-focus.jpg" class="vehicle-image"
                         alt="No hay imagen disponible, imagen por defecto.">
                <?php endif; ?>

                <div class="vehicle-info">
                    <h3><?= $vehicle->getModel()->getBrand()->getName() . " " . $vehicle->getModel()->getName() ?></h3>
                    <p class="detail"><?= number_format($vehicle->getKilometers(), 0, ',', '.') . ' Km' ?? 'Kilómetros no disponibles' ?></p>
                    <p class="detail">Fecha de
                        matriculación: <?= $vehicle->getRegistrationDate()?->format('d-m-Y') ?? 'Fecha no disponible' ?></p>
                    <p class="detail">
                        Motor: <?= $vehicle->getModel()?->getEnginePower() . " " . $vehicle->getFuel() ?? 'Motor no disponible' ?></p>
                    <p class="detail">Transmisión: <?= $vehicle->getGearbox() ?? 'Transmisión no disponible' ?></p>
                    <p class="detail">Color: <?= $vehicle->getColor() ?? 'Color no disponible' ?></p>
                    <p class="detail">Descripción: <?= $vehicle->getDescription() ?? 'Descripción no disponible' ?></p>
                    <p class="detail">
                        Estado: <?= $vehicle->isNew() ? "Nuevo" : "Seminuevo" ?? 'Estado no disponible' ?></p>
                    <p class="detail">Daños
                        observables: <?= $vehicle->getObservedDamages() ?? 'Daños no disponibles' ?></p>
                    <p class="price-garage">Precio:
                        <b><?= number_format($vehicle->getSellPrice(), 0, ',', '.') . ' €' ?? 'Precio no disponible' ?></b>
                    </p>
                    <div class="vehicle-buttons">
                        <a href="/vehicle_detail.php?id=<?= $vehicle->getId(); ?>">
                            <button>Ver detalles</button>
                        </a>
                        <form action="/order_vehicle_delete_process.php" method="post">
                            <input type="hidden" name="vehicle_id" value="<?= $vehicle->getId(); ?>">
                            <button type="submit" class="delete-button">Eliminar del Pedido</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="order-total">
        <p>Total del Pedido: <b><?= number_format($activeOrder->getTotalPrice(), 0, ',', '.'); ?> € </b></p>
        <div class="order-actions">
            <form action="/order_checkout.php" method="post">
                <input type="hidden" name="order_id" value="<?= $activeOrder->getId(); ?>">
                <input type="hidden" name="total_price" value="<?= $activeOrder->getTotalPrice(); ?>">
                <button type="submit" name="submit_order">Tramitar Pedido</button>
            </form>
            <form action="/order_vehicle_cancelled.php" method="post">
                <input type="hidden" name="order_id" value="<?= $activeOrder->getId(); ?>">
                <input type="hidden" name="total_price" value="<?= $activeOrder->getTotalPrice(); ?>">
                <button type="submit" name="submit_order" class="delete-button">Cancelar Pedido</button>
            </form>
        </div>
    </div>
</section>