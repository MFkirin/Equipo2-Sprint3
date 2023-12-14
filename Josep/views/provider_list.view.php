
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
                            <a id="novaSolicitud" href="/provider_create.php">Nova solicitud</a>
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
                    <section>
                        <h2>Proveïdors</h2>
                        <table id="providerList" class="tablesorter">
                            <thead>
                            <tr>
                                <th><span>Id</span><img src="/assets/img/caret-abajo.png" alt="arrow" class="filterArrow"></th>
                                <th><span>Correu Electrònic</span> <img src="/assets/img/caret-abajo.png" alt="arrow" class="filterArrow"></th>
                                <th><span>Telèfon</span> <img src="/assets/img/caret-abajo.png" alt="arrow" class="filterArrow"></th>
                                <th><span>DNI</span> <img src="/assets/img/caret-abajo.png" alt="arrow" class="filterArrow"></th>
                                <th><span>CIF</span> <img src="/assets/img/caret-abajo.png" alt="arrow" class="filterArrow"></th>
                                <th><span>Adreça</span> <img src="/assets/img/caret-abajo.png" alt="arrow" class="filterArrow"></th>
                                <th class="document"><span>Títol de banc</span> <img src="/assets/img/caret-abajo.png" alt="arrow" class="filterArrow"></th>
                                <th ><span>NIF del gerent</span> <img src="/assets/img/caret-abajo.png" alt="arrow" class="filterArrow"></th>
                                <th class="document"><span>Document LOPD</span> <img src="/assets/img/caret-abajo.png" alt="arrow" class="filterArrow"></th>
                                <th class="document"><span> Article de la Constitució</span> <img src="/assets/img/caret-abajo.png" alt="arrow" class="filterArrow"></th>
                                <th colspan="2">Operacions</th>
                            </tr>
                            </thead>
                            <tbody id="providers">
                            <?php foreach ($providers as $provider): ?>
                                <tr>
                                    <td class="show"></span><?= $provider->getId() ?></td>
                                    <td class="show"><span class="mobileTitle">Correu Electrònic: </span><?= $provider->getEmail()?></td>
                                    <td class="show"><span class="mobileTitle">Telèfon: </span><?= $provider->getPhone()?></td>
                                    <td class="show"><span class="mobileTitle">DNI: </span><?= $provider->getDni()?></td>
                                    <td class="noshow"><span class="mobileTitle">CIF: </span><?= $provider->getCif()?></td>
                                    <td class="noshow"><span class="mobileTitle">Adreça: </span><?= $provider->getAddress()?></td>
                                    <td class="document noshow"><span class="mobileTitle">Títol del banc: </span><?= $provider->getBankTitle()?></td>
                                    <td class="noshow"><span class="mobileTitle">NIF del gerent: </span><?= $provider->getManagerNIF() ?></td>
                                    <td class="document noshow"><span class="mobileTitle">Document LOPD: </span><?= $provider->getLOPDdoc() ?></td>
                                    <td class="document noshow"><span class="mobileTitle">Article de la constitució: </span><?= $provider->getConstitutionArticle()?></td>
                                    <td class="noshow"><button class="actions delProvider">Esborrar</button></td>
                                    <td class="noshow"><a href="provider_update.php?id=<?= $provider->getId();?>" class="actions"  id="updProvider" >Actualitzar</a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>

