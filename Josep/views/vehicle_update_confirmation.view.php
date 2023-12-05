<section>
    <h2>Edició de vehicle</h2>

    <form action="/vehicle_update_process.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $vehicleToUpdate->getId(); ?>">

        <div>
            <label>Imatges disponibles del vehicle:</label>
            <table>
                <thead></thead>
                <tbody>
                <?php foreach ($imagesForVehicle as $image): ?>
                    <tr>
                        <td><?= $image->getFilename(); ?></td>
                        <td><a href="/image_delete.php?id=<?= $image->getId(); ?>"
                               class="operation-link delete-link">Eliminar</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <label for="image">Noves imatges:</label>
            <input type="file" id="image" name="image[]" multiple>
        </div>

        <label for="plate">Plate:</label>
        <input type="text" id="plate" name="plate" value="<?= $vehicleToUpdate->getPlate(); ?>" required>

        <label for="observed_damages">Daños observados:</label>
        <textarea id="observed_damages" name="observed_damages"><?= $vehicleToUpdate->getObservedDamages(); ?></textarea>

        <label for="kilometers">Kilometres:</label>
        <input type="number" id="kilometers" name="kilometers" value="<?= $vehicleToUpdate->getKilometers(); ?>">

        <label for="buy_price">Preu de compra:</label>
        <input type="text" id="buy_price" name="buy_price" value="<?= $vehicleToUpdate->getBuyPrice(); ?>">

        <label for="sell_price">Preu de venda:</label>
        <input type="text" id="sell_price" name="sell_price" value="<?= $vehicleToUpdate->getSellPrice(); ?>">

        <label for="fuel">Tipus de combustible:</label>
        <select id="fuel" name="fuel">
            <option value="gasolina" <?= ($vehicleToUpdate->getFuel() === 'gasolina') ? 'selected' : ''; ?>>Gasolina</option>
            <option value="diesel" <?= ($vehicleToUpdate->getFuel() === 'diesel') ? 'selected' : ''; ?>>Diesel</option>
            <option value="electric" <?= ($vehicleToUpdate->getFuel() === 'electric') ? 'selected' : ''; ?>>Electric</option>
        </select>

        <label for="iva">IVA:</label>
        <input type="text" id="iva" name="iva" value="<?= $vehicleToUpdate->getIVA(); ?>">

        <label for="description">Descripcio:</label>
        <textarea id="description" name="description"></textarea>

        <label for="chassis_number">Chassis Number:</label>
        <input type="text" id="chassis_number" name="chassis_number" value="<?= $vehicleToUpdate->getChassisNumber(); ?>">

        <label for="gear_shift">Gear Shift:</label>
        <input type="text" id="gear_shift" name="gear_shift" value="<?= $vehicleToUpdate->getGearShift(); ?>">

        <label for="is_new">El vehicle es nou?:</label>
        <select id="is_new" name="is_new">
            <option value="true" <?= ($vehicleToUpdate->isTransportIncluded() === 'true') ? 'selected' : ''; ?>>Si</option>
            <option value="false" <?= ($vehicleToUpdate->isTransportIncluded() === 'false') ? 'selected' : ''; ?>>No</option>
        </select>

        <label for="transport_included">Transport incluit?:</label>
        <select id="transport_included" name="transport_included">
            <option value="true" <?= ($vehicleToUpdate->isTransportIncluded() === 'true') ? 'selected' : ''; ?>>Si</option>
            <option value="false" <?= ($vehicleToUpdate->isTransportIncluded() === 'false') ? 'selected' : ''; ?>>No</option>
        </select>

        <label for="color">Color:</label>
        <input type="text" id="color" name="color" value="<?= $vehicleToUpdate->getColor(); ?>">

        <label for="registration_date">Data de registre:</label>
        <input type="date" id="registration_date" name="registration_date">

        <label for="model">Model:</label>
        <select id="model" name="model_id">
            <?php foreach ($models as $model): ?>
                <option value="<?= $model->getId() ?>"> <?= $model->getName() ?> </option>
            <?php endforeach; ?>
        </select>

        <label for="provider">Provider:</label>
        <select id="provider" name="provider_id">
            <?php foreach ($providers as $provider): ?>
                <option value="<?= $provider->getId() ?>"> <?= $provider->getEmail() ?> </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Actualizar</button>
    </form>

    <form action="/vehicle_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>