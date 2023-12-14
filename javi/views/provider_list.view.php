<div class="row">
    <div class="col-12">
        <div class="modal">
            <div class="modal-content">

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <h1>Accions</h1>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="head-actions">
            <div class="searcher">
                <label for="inputBuscador" id="pBuscador">Cercador:</label>
                <input id="inputBuscador" placeholder="Cerca">
            </div>
            <div class="new-request">
                <a id="novaSolicitud" href="/provider_create.php"">Nou Proveïdor</a>
            </div>
            <div class="table-selection">
                <button type="button" id="bttn-selection">Selecció Múltiple</button>
                <i id="close-selection" class="fa fa-times"></i>
            </div>
            <div id="divPagines">
                <button class="botonsPagines"><code>&lt;</code></button>
                <span>1/5</span>
                <button class="botonsPagines"><code>&gt;</code></button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div id="div-table">
            <table class="backoffice-table">
                <thead>
                <tr>
                    <th class="multiple-selector"></th>
                    <th><span>Id</span><img src="/assets/img/caret-abajo.png" alt="arrow" class="filterArrow"></th>
                    <th><span>Correu Electrònic</span> <img src="/assets/img/caret-abajo.png" alt="arrow"
                                                            class="filterArrow"></th>
                    <th><span>Telèfon</span> <img src="/assets/img/caret-abajo.png" alt="arrow" class="filterArrow">
                    </th>
                    <th><span>DNI</span> <img src="/assets/img/caret-abajo.png" alt="arrow" class="filterArrow"></th>
                    <th><span>CIF</span> <img src="/assets/img/caret-abajo.png" alt="arrow" class="filterArrow"></th>
                    <th><span>Adreça</span> <img src="/assets/img/caret-abajo.png" alt="arrow" class="filterArrow"></th>
                    <th class="detail"><span>Títol de banc</span> <img src="/assets/img/caret-abajo.png" alt="arrow"
                                                                         class="filterArrow"></th>
                    <th><span>NIF del gerent</span> <img src="/assets/img/caret-abajo.png" alt="arrow"
                                                         class="filterArrow"></th>
                    <th class="detail"><span>Document LOPD</span> <img src="/assets/img/caret-abajo.png" alt="arrow"
                                                                         class="filterArrow"></th>
                    <th class="detail"><span> Article de la Constitució</span> <img src="/assets/img/caret-abajo.png"
                                                                                      alt="arrow" class="filterArrow">
                    </th>
                    <th>Operacions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($providers as $provider): ?>
                    <tr>
                        <td class="multiple-selector">
                            <input type="checkbox" name="multiple-selector">
                        </td>
                        <td data-title="Id:"><?= $provider->getId() ?></td>
                        <td data-title="Correu Electrònic:"><?= $provider->getEmail() ?></td>
                        <td data-title="Telèfon:"><?= $provider->getPhone() ?></td>
                        <td data-title="DNI:"><?= $provider->getDni() ?></td>
                        <td data-title="CIF:"><?= $provider->getCif() ?></td>
                        <td data-title="Adreça:"><?= $provider->getAddress() ?></td>
                        <td data-title="Títol bancari:" class="detail"><?= $provider->getBankTitle() ?></td>
                        <td data-title="NIF del gerent:"><?= $provider->getManagerNIF() ?></td>
                        <td data-title="Document LOPD:" class="detail"><?= $provider->getLOPDdoc() ?></td>
                        <td data-title="Article de la constitució::" class="detail"><?= $provider->getConstitutionArticle() ?></td>
                        <td>
                            <button class="operations-bttn details" type="button"><i class="fas fa-eye"></i></button>
                            <a class="operations-bttn edit"
                               href="provider_update.php?id=<?= $provider->getId(); ?>"><i
                                        class="fas fa-pencil-alt"></i></a>
                            <button class="operations-bttn delete" type="button"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

