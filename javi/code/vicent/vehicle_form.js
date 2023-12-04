document.addEventListener("DOMContentLoaded", function () {

// Obtener referencias a los campos del formulario usando getElementById
    const brand = document.getElementById('brand').value;
    const model = document.getElementById('model').value;
    const color = document.getElementById('color').value;
    const plate = document.getElementById('plate').value;
    const gearShift = document.querySelector('input[name="gearShift"]:checked').value;
    const fuel = document.getElementById('fuel').value;
    const km = document.getElementById('km').value;
    const provider = document.getElementById('provider').value;
    const buyPrice = document.getElementById('buyPrice').value;
    const sellPrice = document.getElementById('sellPrice').value;
    const iva = document.getElementById('iva').value;
    const registrationDate = document.getElementById('registrationDate').value;
    const isNew = document.querySelector('input[name="isNew"]:checked').value;
    const includedTransport = document.querySelector('input[name="includedTransport"]:checked').value;
    const numChassis = document.getElementById('numChassis').value;
    const observedDamages = document.getElementById('observedDamages').value;
    const description = document.getElementById('description').value;

    function validarFormulario() {
        // Variable para validación de la Matrícula (4 números y 3 letras)
        const matriculaRegex = /^[0-9]{4}[A-Z]{3}$/;

        if (!matriculaRegex.test(plate)) {
            alert("La matrícula debe contener 4 números seguidos de 3 letras en mayúsculas.");
            return false;
        }

        // Validar Kilómetros (debe ser un número entero)
        if (isNaN(km) || km % 1 !== 0) {
            alert("El campo Kilómetros debe contener un número entero.");
            return false;
        }

        // Validar Fecha de Primera Matrícula (debe ser una fecha válida)
        if (!registrationDate) {
            alert("El campo Fecha de Primera Matrícula es obligatorio.");
            return false;
        }

        // Validar IVA (debe ser un número con hasta 2 decimales)
        if (isNaN(iva) || !iva.match(/^\d+(\.\d{2})?$/)) {
            alert("El campo IVA debe ser un número con hasta 2 decimales.");
            return false;
        }

        // Validar Imagen (asegurarte de que el campo de imagen no esté vacío)
        const imageInput = document.getElementById('image');
        if (!imageInput.value) {
            alert("Debe adjuntar una imagen del vehículo.");
            return false;
        }

        // Validar Número de Bastidor (debe contener 17 caracteres alfanuméricos)
        if (!numChassis.match(/^[A-HJ-NPR-Z0-9]{17}$/)) {
            alert("El número de bastidor debe contener 17 caracteres alfanuméricos.");
            return false;
        }

        // Validar Marca, Modelo, Color, Proveedor, Precio de Compra y Precio de Venta
        const alphanumericRegex = /^[A-Za-z0-9\s]+$/;
        if (!alphanumericRegex.test(brand)) {
            alert("El campo Marca solo permite letras, números y espacios.");
            return false;
        }
        if (!alphanumericRegex.test(model)) {
            alert("El campo Modelo solo permite letras, números y espacios.");
            return false;
        }
        if (!alphanumericRegex.test(color)) {
            alert("El campo Color solo permite letras, números y espacios.");
            return false;
        }
        if (!alphanumericRegex.test(provider)) {
            alert("El campo Proveedor solo permite letras, números y espacios.");
            return false;
        }

        // Validar Precio de Compra y Precio de Venta (números con hasta 2 decimales)
        if (isNaN(buyPrice) || !buyPrice.match(/^\d+(\.\d{2})?$/)) {
            alert("El Precio de Compra debe ser un número con hasta 2 decimales.");
            return false;
        }
        if (isNaN(sellPrice) || !sellPrice.match(/^\d+(\.\d{2})?$/)) {
            alert("El Precio de Venta debe ser un número con hasta 2 decimales.");
            return false;
        }

        // Validar que al menos una opción esté seleccionada para Tipo de Marcha y Nuevo/Segunda mano
        const gearShiftManual = document.getElementById('gearShift-manual');
        const gearShiftAuto = document.getElementById('gearShift-auto');
        if (!gearShiftManual.checked && !gearShiftAuto.checked) {
            alert("Debes seleccionar el Tipo de Marcha (Manual o Automático).");
            return false;
        }

        const isNewSi = document.getElementById('isNew-si');
        const isNewNo = document.getElementById('isNew-no');
        if (!isNewSi.checked && !isNewNo.checked) {
            alert("Debes seleccionar si el vehículo es Nuevo o de Segunda mano.");
            return false;
        }

        // Validar que al menos una opción esté seleccionada para Transporte incluido en el Precio
        const transportSi = document.getElementById('includedTransport-si');
        const transportNo = document.getElementById('includedTransport-no');
        if (!transportSi.checked && !transportNo.checked) {
            alert("Debes seleccionar si el transporte está incluido en el precio.");
            return false;
        }

        // Si todas las validaciones pasan, el formulario es válido
        return true;
    }
})
