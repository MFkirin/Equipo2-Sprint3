<div class="modal-delete">
    <p>Estas segur d'elimimnar aquest proveïdor?</p>
    <div id="div-table">
        <table class="backoffice-table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Correu Electrònic</th>
                <th>Telèfon</th>
                <th>DNI</th>
                <th>CIF</th>
                <th>Adreça</th>
                <th>Títol de banc
                <th>NIF del gerent</th>
                <th>Document LOPD
                <th>Article de la Constitució</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-title="Id:"><?= $provider->getId() ?></td>
                    <td data-title="Correu Electrònic:"><?= $provider->getEmail() ?></td>
                    <td data-title="Telèfon:"><?= $provider->getPhone() ?></td>
                    <td data-title="DNI:"><?= $provider->getDni() ?></td>
                    <td data-title="CIF:"><?= $provider->getCif() ?></td>
                    <td data-title="Adreça:"><?= $provider->getAddress() ?></td>
                    <td><?= $provider->getBankTitle() ?></td>
                    <td data-title="NIF del gerent:"><?= $provider->getManagerNIF() ?></td>
                    <td><?= $provider->getLOPDdoc() ?></td>
                    <td><?= $provider->getConstitutionArticle() ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <button type="button" class="confirmDel details">Sí</button>
    <button type="button" class="cancelDel delete">Cancelar</button>
</div>