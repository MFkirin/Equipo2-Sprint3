<section>
    <h2>Creació de Proveïdor</h2>

    <form action="/provider_create_process.php" method="post" onsubmit="return validateForm()" novalidate>


        <!-- Domicilio del proveedor -->
        <div class="divDomicilio">
            <label for="completeAddress">Domicilio completo :</label>
            <input type="text" id="completeAddress" name="completeAddress" placeholder="C/SuCalle Nº55 2ºA" required>
            <div id="ErrorDomicilio">
                <p></p>
            </div>
        </div>
        <!-- DNI del proveedor -->
        <div class="divDNI">
            <label for="dni"><abbr title="Documento nacional de identidad">DNI</abbr> :</label>
            <input type="text" id="dni" name="dni" pattern="[0-9]{8}[A-Z]{1}" placeholder="12345678A" required>
            <div id="ErrorDNI">
                <p></p>
            </div>
        </div>
        <!-- Teléfono del proveedor -->
        <div class="divTel">
            <label for="phone">Teléfono :</label>
            <!-- Uso de "pattern" para restringir el input a nueve caracteres numéricos (del 0 al 9)  -->
            <input type="tel" id="phone" name="phone" pattern="[0-9]{9}" placeholder="555444555" maxlength="9" required>
            <div id="ErrorTel">
                <p></p>
            </div>
        </div>
        <!-- Email del proveedor -->
        <div class="divEmail">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" pattern="[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" placeholder="sucorreo@ejemplo.com" required>
            <div id="ErrorEmail">
                <p></p>
            </div>
        </div>
        <!-- CIF del proveedor -->
        <div class="divCIF">
            <label for="CIF"><abbr title="Código de identificación fiscal">CIF</abbr> :</label>
            <input type="text" id="CIF" name="CIF" pattern="[A-Z]{1}[0-9]{7}[A-Z]{1}" placeholder="A1234567B" required>
            <div id="ErrorCIF">
                <p></p>
            </div>
        </div>
        <!-- NIF del gerente del proveedor -->
        <div class="divNIF_gerente">
            <label for="managerNIF"><abbr title="Número de identificación fiscal">NIF</abbr> del gerente:</label>
            <input type="text" id="managerNIF" name="managerNIF" pattern="[0-9]{8}[A-Z]{1}" placeholder="12345678A" required>
            <div id="ErrorNIF_gerente">
                <p></p>
            </div>
        </div>
        <!-- Documento de escritura del proveedor -->
        <div class="divEscritura">
            <label for="constitutionArticle">Escritura constitución :</label>
            <input type="text" id="constitutionArticle" name="constitutionArticle">
            <div id="ErrorEscritura">
                <p></p>
            </div>
        </div>
        <!-- Documento de LOPD -->
        <div class="divLOPD">
            <label for="LOPDdoc"><abbr title="Ley Orgánica de Protección de Datos de Carácter Personal">LOPD</abbr> :</label>
            <input type="text" id="LOPDdoc" name="LOPDdoc">
            <div id="ErrorLOPD">
                <p></p>
            </div>
        </div>
        <!-- Certificado de titularidad de cuenta bancaria del proveedor -->
        <div class="divCertificado_titularidad_cuenta_bancaria">
            <label for="bankTitle">Certificado titularidad cuenta bancaria :</label>
            <input type="text" id="bankTitle" name="bankTitle">
            <div id="ErrorCertificado_titularidad_cuenta_bancaria">
                <p></p>
            </div>
        </div>

        <button type="submit">Crear</button>
    </form>

    <form action="/provider_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>
