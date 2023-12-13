<section>
    <h2>Confirmar Eliminació</h2>

    <p>Vols eliminar aquesta imatge</p>

    <form action="/image_delete_process.php" method="post">
        <input type="hidden" name="id" value="<?= $imageToDelete->getId(); ?>">
        <table>
            <tr>
                <th>Plate</th>
            </tr>
            <tr>
                <td><?= $imageToDelete->getFilename() ?></td>
            </tr>
        </table>

        <button type="submit">Confirmar Eliminació</button>
    </form>

    <form action="/vehicle_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>
