<section id="catalogue-section" class="section-catalog">
    <h1>Catálogo de Vehículos</h1>
    <hr>
    <?php use App\Helper\FlashMessage;

    if (isset($_SESSION["flash-message"]["message"])) {
        echo '<p class="message">' . $_SESSION["flash-message"]["message"] . '</p>';
        FlashMessage::unset("message");
    }; ?>
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
                    <p>Fecha de matriculación: <?= $vehicle->getRegistrationDate()->format('d-m-Y'); ?></p>
                    <p>Precio: <?= $vehicle->getSellPrice(); ?> €</p>
                    <div class="button-container">
                        <a href="/vehicle_detail.php?id=<?= $vehicle->getId(); ?>">
                            <button>Ver detalles</button>
                        </a>
                        <form action="/order_vehicle_add_process.php" method="post">
                            <input type="hidden" name="vehicle_id" value="<?= $vehicle->getId(); ?>">
                            <button type="submit" class="add-to-order-button">Añadir a mi garaje</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>