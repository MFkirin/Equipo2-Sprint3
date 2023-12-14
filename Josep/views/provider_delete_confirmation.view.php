<section>
    <h2>Confirmar Eliminació</h2>

    <p>¿Estàs segur que vols eliminar aquest proveïdor?</p>

    <form action="/provider_delete_process.php" method="post">
        <!-- Incluir el ID del login a eliminar como un campo oculto -->
        <input type="hidden" name="id" value="<?= $providerToDelete->getId(); ?>">
        <table>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Phone</th>
                <th>DNI</th>
                <th>CIF</th>
                <th>Address</th>
                <th>Bank Title</th>
                <th>MangerNIF</th>
                <th>LODP</th>
                <th>Constitution Article</th>
            </tr>
            <tr>
                <td><?=$providerToDelete->getId()?></td>
                <td><?=$providerToDelete->getEmail()?></td>
                <td><?=$providerToDelete->getPhone()?></td>
                <td><?=$providerToDelete->getDNI()?></td>
                <td><?=$providerToDelete->getCIF()?></td>
                <td><?=$providerToDelete->getAddress()?></td>
                <td><?=$providerToDelete->getBankTitle()?></td>
                <td><?=$providerToDelete->getManagerNIF()?></td>
                <td><?=$providerToDelete->getLOPDdoc()?></td>
                <td><?=$providerToDelete->getConstitutionArticle()?></td>
            </tr>
        </table>

        <button type="submit">Confirmar Eliminación</button>
    </form>
    <form action="/provider_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>
