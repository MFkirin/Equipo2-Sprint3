<section class="section-vehicle-detail">
    <?php use App\Helper\FlashMessage;

    if (isset($_SESSION["flash-message"]["message"])) {
        echo '<p class="message">' . $_SESSION["flash-message"]["message"] . '</p>';
        FlashMessage::unset("message");
    }; ?>
    <a href="/catalogue_list.php" class="back-button">
        <button>Volver al catálogo</button>
    </a>
    <div class="vehicle-detail-container">
        <img src="../assets/img/vehicles/<?= $vehicle->getImages()[0]?->getFilename() ?? 'ford-focus.jpg' ?>"
             class="vehicle-detail-image"
             alt="<?= $vehicle->getModel()?->getBrand()->getName() . " " . $vehicle->getModel()?->getName() . " Image" ?? 'Imagen no disponible' ?>">
        <div class="vehicle-detail-info">
            <h1><?= $vehicle->getModel()?->getBrand()->getName() . " " . $vehicle->getModel()?->getName() ?? 'Modelo no disponible' ?></h1>
            <h3><?= number_format($vehicle->getSellPrice(), 0, ',', '.') . ' €' ?? 'Precio no disponible' ?></h3>
            <p class="detail"><?= number_format($vehicle->getKilometers(), 0, ',', '.') . ' Km' ?? 'Kilómetros no disponibles' ?></p>
            <p class="detail">Fecha de
                matriculación: <?= $vehicle->getRegistrationDate()?->format('d-m-Y') ?? 'Fecha no disponible' ?></p>
            <p class="detail">
                Motor: <?= $vehicle->getModel()?->getEnginePower() . " " . $vehicle->getFuel() ?? 'Motor no disponible' ?></p>
            <p class="detail">Transmisión: <?= $vehicle->getGearbox() ?? 'Transmisión no disponible' ?></p>
            <p class="detail">Color: <?= $vehicle->getColor() ?? 'Color no disponible' ?></p>
            <p class="detail">Descripción: <?= $vehicle->getDescription() ?? 'Descripción no disponible' ?></p>
            <p class="detail">Estado: <?= $vehicle->isNew() ? "Nuevo" : "Seminuevo" ?? 'Estado no disponible' ?></p>
            <p class="detail">Daños observables: <?= $vehicle->getObservedDamages() ?? 'Daños no disponibles' ?></p>
            <div class="button-container">
                <form action="/order_vehicle_add_process.php" method="post">
                    <input type="hidden" name="vehicle_id" value="<?= $vehicle->getId(); ?>">
                    <button type="submit" class="add-to-order-button">Añadir a mi garaje</button>
                </form>
            </div>
        </div>
    </div>
</section>