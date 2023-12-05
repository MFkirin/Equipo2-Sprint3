<section>
    <h2>Inicis de proveïdors</h2>
    <a href="/provider_create.php">
        <button type="button" class="create-login-button">Crear Nuevo Proveïdor</button>
    </a>

    <input id="providerSearcher" type="text" placeholder="Search..">
    <a href="/grafica.php">
        <button type="button" class="create-login-button">Vore grafica</button>
    </a>
    <br><br>
    <div class="modal fade" hidden="hidden" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

            <div class="modal-content">
                <button type="button" style="float: right;" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal-header">

                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>

                </div>
                <div class="modal-body">
                    ¿Seguro que desea eliminar este proveedor?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <table>
        <thead>
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
        </thead>
        <tbody id="providerTable">
        <?php foreach ($providers as $provider): ?>
            <tr>
                <td><?=$provider->getId()?></td>
                <td><?=$provider->getEmail()?></td>
                <td><?=$provider->getPhone()?></td>
                <td><?=$provider->getDNI()?></td>
                <td><?=$provider->getCIF()?></td>
                <td><?=$provider->getAddress()?></td>
                <td><?=$provider->getBankTitle()?></td>
                <td><?=$provider->getManagerNIF()?></td>
                <td><?=$provider->getLOPDdoc()?></td>
                <td><?=$provider->getConstitutionArticle()?></td>
                <td><a href="/provider_update.php?id=<?= $provider->getId(); ?>" class="operation-link edit-link">Editar</a>
                </td>
                <td><a href="#" class="operation-link delete-link" data-id="<?= $provider->getId(); ?>" data-modal="#deleteModal">
                        Eliminar
                    </a></td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</section>
