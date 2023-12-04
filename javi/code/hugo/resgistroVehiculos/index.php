<?php
session_start();
if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"/>
    <title>Dar de alta un vehículo</title>
    <!-- <script src="index.js"></script> -->
</head>

<body>
<h1>Dar de alta un nuevo vehículo</h1>
<section>
    <article>
        <form method="post" enctype="multipart/form-data" action="alta_vehicle.php">
            <!-- Nombre del vehículo -->
            <div>
                <label for="nombre-vehiculo">Nombre del vehículo:</label>
                <input type="text" required id="nombre-vehiculo" name="nombre-vehiculo" pattern="^[A-Za-z0-9\s]+$"
                       title="Solo se permiten letras, números y espacios"/>
            </div>

            <!-- Marca del vehículo -->
            <div>
                <label for="marca">Marca:</label>
                <input type="text" required id="marca" name="marca" pattern="^[A-Za-z0-9\s]+$"
                       title="Solo se permiten letras, números y espacios"/>
            </div>

            <!-- Modelo del vehículo respecto a su marca -->
            <div>
                <label for="modelo">Modelo:</label>
                <input type="text" required id="modelo" name="modelo" pattern="^[A-Za-z0-9\s]+$"
                       title="Solo se permiten letras, números y espacios"/>
            </div>


            <!-- Matrícula Española 4 números y 3 letras -->
            <div>
                <label for="matricula">Matrícula <abbr title="required" aria-label="required">*</abbr>:</label>
                <input type="text" required id="matricula" name="matricula" pattern="^\d{4}[A-Z]{3}$"
                       title="Debe contener 4 números seguidos de 3 letras en mayúsculas"/>
            </div>

            <!-- Tipo de marchas que tiene el coche Automaticas / Manuales -->
            <div>
                <label for="tipMarcha">Tipo de Marcha:</label>
                <input type="radio" id="tipMarcha-manual" name="tipMarcha" value="manual">
                <label for="tipMarcha-manual">Manual</label>
                <input type="radio" id="tipMarcha-automatico" name="tipMarcha" value="automatico">
                <label for="tipMarcha-automatico">Automático</label>
            </div>

            <!-- Kilometraje que tiene el vehículo -->
            <div>
                <label for="kilometro">Kilómetros del vehículo <abbr title="required"
                                                                     aria-label="required">*</abbr>:</label>
                <input type="number" required id="kilometro" name="kilometro" pattern="\d+"
                       title="Debe ser un número entero"/>
            </div>

            <!-- Precio de compra al proveedor -->
            <div>
                <label for="precComp">Precio de Compra:</label>
                <input type="number" required id="precComp" name="precComp" step="0.01" pattern="\d+(\.\d{2})?"
                       title="Debe ser un número (puede incluir hasta 2 decimales)"/>
            </div>

            <!-- Precio de venta al cliente "P.V.P" -->
            <div>
                <label for="precVenta">Precio de Venta:</label>
                <input type="number" required id="precVenta" name="precVenta" step="0.01" pattern="\d+(\.\d{2})?"
                       title="Debe ser un número (puede incluir hasta 2 decimales)"/>
            </div>

            <!-- IVA correspondiente establecida por La Agencia Estatal de Administración Tributaria -->
            <div>
                <label for="IVA">IVA <abbr title="required" aria-label="required">*</abbr>:</label>
                <input type="number" required id="IVA" name="IVA" step="0.01" pattern="\d+(\.\d{2})?"
                       title="Debe ser un número (puede incluir hasta 2 decimales)" value="21" readonly/>
            </div>

            <!-- Fecha de la primera matriculación del vehículo -->
            <div>
                <label for="fPrimerMatric">Fecha de Primera Matrícula <abbr title="required"
                                                                            aria-label="required">*</abbr>:</label>
                <input type="date" required id="fPrimerMatric" name="fPrimerMatric"/>
            </div>

            <!-- Tipo de carburante -->
            <div>
                <label for="tipCarbur">Tipo de Carburante:</label>
                <select name="tipCarbur" id="tipCarbur">
                    <option value="diesel">Diesel</option>
                    <option value="gasolina" selected>Gasolina</option>
                    <option value="electrico">Eléctrico</option>
                    <option value="hibrido">Híbrido</option>
                </select>
            </div>

            <!-- Señalización del estado del vehículo, Nuevo / Segunda mano -->
            <div>
                <label for="nuevo">Nuevo:</label>
                <input type="radio" name="nuevo" value="Si" id="nuevo-si">
                <label for="nuevo-si">Si</label>
                <input type="radio" name="nuevo" value="No" id="nuevo-no">
                <label for="nuevo-no">No</label>
            </div>

            <!-- Señalización sobre el transporte incluido en el precio -->
            <div>
                <label for="transInc">Transporte incluido en el Precio:</label>
                <input type="radio" name="transInc" value="Si" id="transInc-si">
                <label for="transInc-si">Si</label>
                <input type="radio" name="transInc" value="No" id="transInc-no">
                <label for="transInc-no">No</label>
            </div>

            <!-- Número de Bastidor del vehículo -->
            <div>
                <label for="numBast">Número de Bastidor <abbr title="required" aria-label="required">*</abbr>:</label>
                <input type="text" required id="numBast" name="numBast" pattern="^[A-HJ-NPR-Z0-9]{17}$"
                       title="Debe contener 17 caracteres alfanuméricos"/>
            </div>


            <!-- Imágenes del vehículo -->
            <div>
                <label for="imagen">Imagen <abbr title="required" aria-label="required">*</abbr>:</label>
                <input type="file" id="imagen" name="imagen"/>
            </div>

            <!-- Daños observados y especificación en caso de ser afirmativo -->
            <div>
                <label for="danoObs">Daños Observados:</label>
                <textarea id="danoObs" name="danoObs"></textarea>
            </div>

            <div>
                <label for="desCom">Descripción Comercial:</label>
                <textarea id="desCom" name="desCom"></textarea>
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
    <!-- Aquí irá el footer en una versión más avanzada -->
</footer>
</body>

</html>