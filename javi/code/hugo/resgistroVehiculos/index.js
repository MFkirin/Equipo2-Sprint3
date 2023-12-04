document.addEventListener("DOMContentLoaded", function () {

    // Obtener referencias a los campos del formulario
    const nombreVehiculo = document.querySelector('input[name="nombre-vehiculo"]');
    const matricula = document.querySelector('input[name="matricula"]');
    const kilometro = document.querySelector('input[name="kilometro"]');
    const fPrimerMatric = document.querySelector('input[name="fPrimerMatric"]');
    const IVA = document.querySelector('input[name="IVA"]');
    const imagen = document.querySelector('input[name="imagen"]');
    const numBast = document.querySelector('input[name="numBast"]');
    const todosInputs = document.querySelectorAll('input');

    // Función para validar el formulario
    function validarFormulario() {
        // Variable para validación de la Matrícula (4 números y 3 letras)
        const matriculaRegex = /^[0-9]{4}[A-Z]{3}$/;

        if (!matriculaRegex.test(matricula.value)) {
            alert("La matrícula debe contener 4 números seguidos de 3 letras en mayúsculas.");
            return false;
        }

        // Validar Kilómetros (debe ser un número)
        if (isNaN(kilometro.value)) {
            alert("El campo Kilómetros debe contener solo números.");
            return false;
        }

        // Validar Fecha de Primera Matrícula (debe ser una fecha válida)
        if (!fPrimerMatric.value) {
            alert("El campo Fecha de Primera Matrícula es obligatorio.");
            return false;
        }

        // Validar IVA (debe ser un número)
        if (isNaN(IVA.value)) {
            alert("El campo IVA debe contener solo números.");
            return false;
        }

        // Validar Image (debe contener un archivo)
        if (!imagen.value) {
            alert("Debe adjuntar una imagen del vehículo.");
            return false;
        }

        // Validar Número de Bastidor (debe tener al menos 17 caracteres)
        if (numBast.value.length < 17) {
            alert("El número de bastidor debe tener al menos 17 caracteres.");
            return false;
        }

        // Si todas las validaciones pasan, el formulario es válido
        return true;
    }

    function previewImage() {
        var input = document.getElementById('imagen');
        var preview = document.getElementById('imagen-preview');
        var image = document.getElementById('imagen-img');
        var file = input.files[0];
        var reader = new FileReader();

        reader.onload = function () {
            image.src = reader.result;
            preview.style.display = 'block';
        };

        if (file) {
            reader.readAsDataURL(file);
        } else {
            image.src = '';
            preview.style.display = 'none';
        }
    }


    function guardarEnLocalStorage() {
        let nombreLS = nombreVehiculo.value;
        let matriculaLS = matricula.value;
        let kilometroLS = kilometro.value;
        let fPrimerMatricLS = fPrimerMatric.value;
        let IVALS = IVA.value;
        let imagenLS = imagen.value;
        let numBastLS = numBast.value;

        // Guardar datos dentro del objeto
        let formData = {
            nombreLS: nombreLS,
            matriculaLS: matriculaLS,
            kilometroLS: kilometroLS,
            fPrimerMatricLS: fPrimerMatricLS,
            IVALS: IVALS,
            imagenLS: imagenLS,
            numBastLS: numBastLS
        }

        // Convertir el objeto a una cadena JSON
        let formDataJSON = JSON.stringify(formData);

        // Guardar en el localStorage
        localStorage.setItem("formData", formDataJSON);

        // Contar los clics en el botón de enviar
        let clicks = parseInt(getCookie("clicks")) || 0;
        clicks++;
        setCookie("clicks", clicks, 365);
    }

    // Función para establecer una cookie
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = "expires=" + date.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }

    function getCookie(name) {
        const cookieName = name + "=";
        const decodedCookie = decodeURIComponent(document.cookie);
        const cookieArray = decodedCookie.split(';');
        for (let i = 0; i < cookieArray.length; i++) {
            let cookie = cookieArray[i];
            while (cookie.charAt(0) === ' ') {
                cookie = cookie.substring(1);
            }
            if (cookie.indexOf(cookieName) === 0) {
                return cookie.substring(cookieName.length, cookie.length);
            }
        }
        return "";
    }

    function cargarDatosFormularioLocalStorage() {
        let formDataJSON = localStorage.getItem("formData");

        if (formDataJSON) {
            // Convertir cadena JSON a objeto
            let formData = JSON.parse(formDataJSON);

            // Asignar valores a los campos del formulario
            nombreVehiculo.value = formData.nombreLS;
            matricula.value = formData.matriculaLS;
            kilometro.value = formData.kilometroLS;
            fPrimerMatric.value = formData.fPrimerMatricLS;
            IVA.value = formData.IVALS;
            console.log(imagen.value);
            //imagen.value = formData.imagenLS;
            numBast.value = formData.numBastLS;
        }
    }

    // Llamar a la función para cargar datos del localStorage cuando se carga la página
    cargarDatosFormularioLocalStorage();

    const formulario = document.querySelector('form');
    const botonEnviar = document.querySelector('input[type="submit"]');

    // Agregar un evento al formulario para llamar a la función de validación cuando se envíe
    formulario.addEventListener('submit', function (event) {
        if (!validarFormulario()) {
            event.preventDefault(); // Evitar el envío del formulario si no es válido
        } else {
            guardarEnLocalStorage();
        }
    });


    // Agregar un evento al botón de enviar para contar los clics
    botonEnviar.addEventListener('click', function () {
        guardarEnLocalStorage();
    });

})
