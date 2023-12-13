// validation.js
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    form.addEventListener('submit', function (event) {
        // Obtén todos los campos de entrada para validar
        const nombreVehiculoInput = document.getElementById('nombre-vehiculo');
        const marcaInput = document.getElementById('marca');
        const modeloInput = document.getElementById('modelo');
        const matriculaInput = document.getElementById('matricula');
        const kilometroInput = document.getElementById('kilometro');
        const numBastInput = document.getElementById('numBast');
        const fPrimerMatricInput = document.getElementById('fPrimerMatric');
        const tipCarburInput = document.getElementById('tipCarbur');

        // Validar los campos y mostrar mensajes de error
        if (!nombreVehiculoInput.checkValidity()) {
            alert('Nombre del vehículo no es válido: ' + nombreVehiculoInput.validationMessage);
            event.preventDefault();
        }

        if (!marcaInput.checkValidity()) {
            alert('Marca no es válida: ' + marcaInput.validationMessage);
            event.preventDefault();
        }

        if (!modeloInput.checkValidity()) {
            alert('Modelo no es válido: ' + modeloInput.validationMessage);
            event.preventDefault();
        }

        if (!matriculaInput.checkValidity()) {
            alert('Matrícula no es válida: ' + matriculaInput.validationMessage);
            event.preventDefault();
        }

        if (!kilometroInput.checkValidity()) {
            alert('Kilómetros no son válidos: ' + kilometroInput.validationMessage);
            event.preventDefault();
        }

        if (!numBastInput.checkValidity()) {
            alert('Número de Bastidor no es válido: ' + numBastInput.validationMessage);
            event.preventDefault();
        }

        if (!fPrimerMatricInput.checkValidity()) {
            alert('Fecha de Primera Matrícula no es válida: ' + fPrimerMatricInput.validationMessage);
            event.preventDefault();
        }

        if (!tipCarburInput.checkValidity()) {
            alert('Tipo de Carburante no es válido: ' + tipCarburInput.validationMessage);
            event.preventDefault();
        }
    });
});
