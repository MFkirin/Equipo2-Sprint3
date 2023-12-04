<section>
    <h2>Nou vehicle</h2>

    <form action="/vehicle_create_process.php" method="post" enctype="multipart/form-data">

        <label for="plate">Plate:</label>
        <input type="text" id="plate" name="plate">

        <label for="observed_damages">Danys observats:</label>
        <textarea id="observed_damages" name="observed_damages"></textarea>

        <label for="kilometers">Kilometres:</label>
        <input type="number" id="kilometers" name="kilometers">

        <label for="buy_price">Preu de compra:</label>
        <input type="text" id="buy_price" name="buy_price">

        <label for="sell_price">Preu de venda:</label>
        <input type="text" id="sell_price" name="sell_price">

        <label for="fuel">Tipus de combustible:</label>
        <select id="fuel" name="fuel">
            <option value="gasolina">Gasolina</option>
            <option value="diesel">Diesel</option>
            <option value="electric">Electric</option>
        </select>

        <label for="iva">IVA:</label>
        <input type="text" id="iva" name="iva">

        <label for="description">Descripcio:</label>
        <textarea id="description" name="description"></textarea>

        <label for="chassis_number">Chassis Number:</label>
        <input type="text" id="chassis_number" name="chassis_number">

        <label for="gear_shift">Gear Shift:</label>
        <input type="text" id="gear_shift" name="gear_shift">

        <label for="is_new">El vehicle es nou?:</label>
        <select id="is_new" name="is_new">
            <option value="true">Si</option>
            <option value="false">No</option>
        </select>

        <label for="transport_included">Transport incluit?:</label>
        <select id="transport_included" name="transport_included">
            <option value="true">Si</option>
            <option value="false">No</option>
        </select>

        <label for="color">Color:</label>
        <input type="text" id="color" name="color">

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

        <label for="image">Image:</label>
        <input type="file" id="image" name="image[]" multiple>

        <button type="submit">Crear</button>
    </form>

    <form action="/vehicle_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>