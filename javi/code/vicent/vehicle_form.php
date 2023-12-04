<?php
session_start();
if (!isset($_SESSION['csrf'])) {
    try {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    } catch (Exception $e) {
    }
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css"/>
    <title>Dar de alta un vehículo</title>
    <script src="vehicle_form.js"></script>
</head>

<body>
<h1>Dar de alta un vehículo</h1>
<section>
    <article>
        <form method="post" enctype="multipart/form-data" action="vehicle_form_process.php">
            <!-- Marca del vehículo -->
            <div>
                <label for="brand">Marca:</label>
                <input type="text" required id="brand" name="brand" pattern="^[A-Za-z0-9\s]+$"
                       title="Solo se permiten letras, números y espacios"/>
            </div>

            <!-- Modelo del vehículo respecto a su marca -->
            <div>
                <label for="model">Modelo:</label>
                <input type="text" required id="model" name="model" pattern="^[A-Za-z0-9\s]+$"
                       title="Solo se permiten letras, números y espacios"/>
            </div>

            <!-- Color -->
            <div>
                <label for="color">Color:</label>
                <input type="text" required id="color" name="color" pattern="^[A-Za-z0-9\s]+$"
                       title="Solo se permiten letras, números y espacios"/>
            </div>

            <!-- Matrícula Española 4 números y 3 letras -->
            <div>
                <label for="plate">Matrícula <abbr title="required" aria-label="required">*</abbr>:</label>
                <input type="text" required id="plate" name="plate" pattern="^\d{4}[A-Z]{3}$"
                       title="Debe contener 4 números seguidos de 3 letras en mayúsculas"/>
            </div>

            <!-- Tipo de marchas que tiene el coche Automaticas / Manuales -->
            <div>
                <label for="gearShift">Tipo de Marcha:</label>
                <input type="radio" id="gearShift-manual" name="gearShift" value="manual">
                <label for="gearShift-manual">Manual</label>
                <input type="radio" id="gearShift-auto" name="gearShift" value="auto">
                <label for="gearShift-auto">Automático</label>
            </div>

            <!-- Tipo de carburante -->
            <div>
                <label for="fuel">Tipo de Carburante:</label>
                <select name="fuel" id="fuel">
                    <option value="diesel">Diesel</option>
                    <option value="gasolina" selected>Gasolina</option>
                    <option value="electrico">Eléctrico</option>
                    <option value="hibrido">Híbrido</option>
                </select>
            </div>

            <!-- Kilometraje que tiene el vehículo -->
            <div>
                <label for="km">Kilómetros del vehículo <abbr title="required"
                                                              aria-label="required">*</abbr>:</label>
                <input type="number" required id="km" name="km" pattern="\d+"
                       title="Debe ser un número entero"/>
            </div>

            <!-- Proveedor -->
            <div>
                <label for="provider">Proveedor:</label>
                <input type="text" required id="provider" name="provider" pattern="^[A-Za-z0-9\s]+$"
                       title="Solo se permiten letras, números y espacios"/>
            </div>

            <!-- Precio de compra al proveedor -->
            <div>
                <label for="buyPrice">Precio de Compra:</label>
                <input type="number" required id="buyPrice" name="buyPrice" step="0.01" pattern="\d+(\.\d{2})?"
                       title="Debe ser un número (puede incluir hasta 2 decimales)"/>
            </div>

            <!-- Precio de venta al cliente "P.V.P" -->
            <div>
                <label for="sellPrice">Precio de Venta:</label>
                <input type="number" required id="sellPrice" name="sellPrice" step="0.01" pattern="\d+(\.\d{2})?"
                       title="Debe ser un número (puede incluir hasta 2 decimales)"/>
            </div>

            <!-- IVA correspondiente establecida por La Agencia Estatal de Administración Tributaria -->
            <div>
                <label for="iva">iva <abbr title="required" aria-label="required">*</abbr>:</label>
                <input type="number" required id="iva" name="iva" step="0.01" pattern="\d+(\.\d{2})?"
                       title="Debe ser un número (puede incluir hasta 2 decimales)" value="21" readonly/>
            </div>

            <!-- Fecha de la primera matriculación del vehículo -->
            <div>
                <label for="registrationDate">Fecha de Primera Matrícula <abbr title="required"
                                                                               aria-label="required">*</abbr>:</label>
                <input type="date" required id="registrationDate" name="registrationDate"/>
            </div>

            <!-- Señalización del estado del vehículo, Nuevo / Segunda mano -->
            <div>
                <label for="isNew">Nuevo:</label>
                <input type="radio" name="isNew" value="Si" id="isNew-si">
                <label for="isNew-si">Si</label>
                <input type="radio" name="isNew" value="No" id="isNew-no">
                <label for="isNew-no">No</label>
            </div>

            <!-- Señalización sobre el transporte incluido en el precio -->
            <div>
                <label for="includedTransport">Transporte incluido en el Precio:</label>
                <input type="radio" name="includedTransport" value="Si" id="includedTransport-si">
                <label for="includedTransport-si">Si</label>
                <input type="radio" name="includedTransport" value="No" id="includedTransport-no">
                <label for="includedTransport-no">No</label>
            </div>

            <!-- Número de Bastidor del vehículo -->
            <div>
                <label for="numChassis">Número de Bastidor <abbr title="required"
                                                                 aria-label="required">*</abbr>:</label>
                <input type="text" required id="numChassis" name="numChassis" pattern="^[A-HJ-NPR-Z0-9]{17}$"
                       title="Debe contener 17 caracteres alfanuméricos"/>
            </div>

            <!-- Daños observados y especificación en caso de ser afirmativo -->
            <div>
                <label for="observedDamages">Daños Observados:</label>
                <textarea id="observedDamages" name="observedDamages"></textarea>
            </div>

            <!-- Descripción del vehículo -->
            <div>
                <label for="description">Descripción:</label>
                <textarea id="description" name="description"></textarea>
            </div>

            <!-- Imágenes del vehículo -->
            <div>
                <label for="image">Imagen <abbr title="required" aria-label="required">*</abbr>:</label>
                <input type="file" id="image" name="image"/>
            </div>
            <!-- Agrega un campo oculto con el token CSRF en el formulario -->
            <div>
                <input type="hidden" id="csrf" name="csrf" value="<?php echo $_SESSION['csrf']; ?>"/>
            </div>
            <button type="submit" value="Enviar">Enviar</button>
            <button type="reset" value="Rellenar">Rellenar</button>
        </form>
    </article>
</section>

<footer>
</footer>
</body>

</html>