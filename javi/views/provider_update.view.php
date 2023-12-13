<div class="container">
    <h1>Actualize sus datos</h1>
    <form action="../provider_update_process.php?id=<?=$_GET['id'] ?>" id="form-control" method="post" novalidate="novalidate">
        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" placeholder="ejemplo@gmail.com" value="<?= $provider->getEmail() ?>" required><span id="emailError" class="error"></span>
            <div id="ErrorEmail">
                <p></p>
            </div>
        </div>
        <!-- Teléfono del proveedor -->
        <div class="form-group">
            <label for="phone">Teléfono:</label>
            <input type="text" name="phone" id="phone" placeholder="999999999" value="<?= $provider->getPhone() ?>" required><span id="phoneError" class="error"></span>
            <div id="ErrorPhone">
                <p></p>
            </div>
        </div>
        <!-- DNI del proveedor -->
        <div class="form-group">
            <label for="dni">DNI:</label>
            <input type="text" name="dni" id="dni" placeholder="12345678K" value="<?= $provider->getDni() ?>" required><span id="dniError" class="error"></span>
            <div id="ErrorDNI">
                <p></p>
            </div>
        </div>
        <!-- CIF del proveedor -->
        <div class="form-group">
            <label for="cif">CIF:</label>
            <input type="text" name="cif" id="cif"  placeholder="A12345678" value="<?= $provider->getCif() ?>" required>
            <div id="ErrorCIF">
                <p></p>
            </div>
        </div>
        <!-- Domicilio del proveedor -->
        <div class="form-group">
            <label for="address">Domicilio:</label>
            <input type="text" name="address" id="address" placeholder="Calle Ausias March Nª2, Almeria, Andalucía, España" value="<?= $provider->getAddress() ?>"required>
            <div id="ErrorAddress">
                <p></p>
            </div>
        </div>
        <!-- Titulo del banco -->
        <div class="form-group">
            <label for="bankTitle">Título del Banco:</label>
            <input type="file" class="docBrowser" name="bankTitle" id="bankTitle" placeholder="Nombre del Banco" required>
            <div id="ErrorBankTitle">
                <p></p>
            </div>
        </div>
        <!-- NIF del gerente del proveedor -->
        <div class="form-group">
            <label for="managerNIF">NIF del jerente:</label>
            <input type="text" name="managerNIF" id="managerNIF" placeholder="12345678Y" value="<?= $provider->getManagerNif() ?>" required>
            <div id="ErrorManagerNIF">
                <p></p>
            </div>
        </div>
        <!-- Documento LOPD -->
        <div class="form-group">
            <label for="LOPDdoc">Documento LOPD:</label>
            <input type="file" class="docBrowser" name="LOPDdoc" id="LOPDdoc" placeholder="" required>
            <div id="ErrorLOPDdoc">
                <p></p>
            </div>
        </div>
        <!-- Articulo de la constitución -->
        <div class="form-group">
            <label for="constitutionArticle">Artículo de la constitución:</label>
            <input type="file" name="constitutionArticle" id="constitutionArticle" placeholder="" value="<?= $provider->getConstitutionArticle() ?>" required>
            <div id="ErrorConstitutionArticle">
                <p></p>
            </div>
        </div>
        <div class="form-group">
            <button type="submit">Actualizar</button>
        </div>
    </form>
</div>