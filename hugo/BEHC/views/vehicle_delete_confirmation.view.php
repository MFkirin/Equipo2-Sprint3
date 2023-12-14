<section>
    <h2>Confirmar Eliminació</h2>

    <p>Vols eliminar este vehicle?</p>

    <form action="/vehicle_delete_process.php" method="post">
        <input type="hidden" name="id" value="<?= $vehicleToDelete->getId(); ?>">
        <table>
            <tr>
                <th>Plate</th>
            </tr>
            <tr>
                <td><?= $vehicleToDelete->getPlate() ?></td>
            </tr>
        </table>

        <button type="submit">Confirmar Eliminació</button>
    </form>
    <form action="/vehicle_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>