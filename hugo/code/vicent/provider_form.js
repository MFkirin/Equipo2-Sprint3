document.addEventListener("DOMContentLoaded", function () {
  // Creación de variables

  // Inputs
  let nombreInput = document.getElementById("nombre");
  let domicilioInput = document.getElementById("domicilio");
  let DNIInput = document.getElementById("DNI");
  let telInput = document.getElementById("tel");
  let emailInput = document.getElementById("email");
  let CIFInput = document.getElementById("CIF");
  let NIFGerenteInput = document.getElementById("NIF_gerente");

  // Obtener todos los inputs en una colección de elementos
  let todosInputs = document.querySelectorAll("input");

  // Llamamos a las funciones de validar cuando se interactúa con los campos
  nombreInput.addEventListener("input", validarNombre);
  domicilioInput.addEventListener("input", validarDomicilio);
  DNIInput.addEventListener("input", validarDNI);
  telInput.addEventListener("input", validarTelefono);
  emailInput.addEventListener("input", validarEmail);
  CIFInput.addEventListener("input", validarCIF);
  NIFGerenteInput.addEventListener("input", validarNIFGerente);

  // Agregar eventos "blur" para validar cuando se pierde el foco
  nombreInput.addEventListener("blur", validarNombre);
  domicilioInput.addEventListener("blur", validarDomicilio);
  DNIInput.addEventListener("blur", validarDNI);
  telInput.addEventListener("blur", validarTelefono);
  emailInput.addEventListener("blur", validarEmail);
  CIFInput.addEventListener("blur", validarCIF);
  NIFGerenteInput.addEventListener("blur", validarNIFGerente);

  // Botón borrar contenido formulario 
  let botonBorrar = document.getElementById("borrar");
  botonBorrar.addEventListener("click", function () {
    // Vacía el contenido de los inputs
    nombreInput.value = "";
    domicilioInput.value = "";
    DNIInput.value = "";
    telInput.value = "";
    emailInput.value = "";
    CIFInput.value = "";
    NIFGerenteInput.value = "";
    // Elimina el objeto para que no se vuelvan a llenar los inputs
    localStorage.removeItem("formData");
  });

  // Botón de enviar
  let botonEnviar = document.getElementById("enviar");
  botonEnviar.addEventListener("click", function (event) {
    event.preventDefault(); // Evita que el formulario se envíe si hay errores

    // Verifica no haya inputs vacíos o con errores
    let todosLosCamposValidos = Array.from(todosInputs).every(function (input) {
      return input.value.trim() !== "" && !input.style.borderColor;
    });

    if (todosLosCamposValidos) {
      // Guardar datos automáticamente al enviar el formulario
      guardarDatosFormularioEnLocalStorage();
      alert("Formulario enviado correctamente");
      // Aquí puedes agregar código para enviar el formulario
    } else {
      alert("Por favor, complete todos los campos correctamente");
    }
  });

  //Botón aceptar cookies
  let botonCookies = document.getElementById("botonCookies");
  botonCookies.addEventListener("click", eliminaDivCookies);
  let divCookies = document.getElementById("divCookies");
  //Eliminamos el div con el mensaje de las cookies cuando el usuario pulsa el botón de aceptar
  function eliminaDivCookies(){
    divCookies.remove();
   
  }

  //Eliminamos la cookie si el usuario rechaza du uso 
  let botonRechazarCookies = document.getElementById("botonRechazarCookies")
  botonRechazarCookies.addEventListener("click", function(){
    //Establecemos una fecha de caducidad en el pasado para que se considere caducada y se elimine
    document.cookie = 'visitas=1; expires=Fri, 31 Dec 1999 23:59:59 GMT; path=/;';
    divCookies.remove();
    
  })

  // Cargar automáticamente los datos almacenados al cargar la página
  cargarDatosFormularioDesdeLocalStorage();

  // Cambiamos el color de los mensajes de error a rojo
  let divErrorNombre = document.getElementById("ErrorNombre");
  let divErrorDomicilio = document.getElementById("ErrorDomicilio");
  let divErrorDNI = document.getElementById("ErrorDNI");
  let divErrorTel = document.getElementById("ErrorTel");
  let divErrorEmail = document.getElementById("ErrorEmail");
  let divErrorCIF = document.getElementById("ErrorCIF");
  let divErrorNIF_gerente = document.getElementById("ErrorNIF_gerente");

  let errorNombre = divErrorNombre.querySelector("p");
  let errorDomicilio = divErrorDomicilio.querySelector("p");
  let errorDNI = divErrorDNI.querySelector("p");
  let errorTel = divErrorTel.querySelector("p");
  let errorEmail = divErrorEmail.querySelector("p");
  let errorCIF = divErrorCIF.querySelector("p");
  let errorNIF_gerente = divErrorNIF_gerente.querySelector("p");

  errorNombre.style.color = "red";
  errorDomicilio.style.color = "red";
  errorDNI.style.color = "red";
  errorTel.style.color = "red";
  errorEmail.style.color = "red";
  errorCIF.style.color = "red";
  errorNIF_gerente.style.color = "red";

  function aplicarEstiloError(inputElement) {
    inputElement.style.borderColor = 'red';
  }

  function quitarEstiloError(inputElement) {
    inputElement.style.borderColor = ''; // Restaura el estilo por defecto
  }

  // Función cookies
  // Verificar si la cookie 'visitas' ya existe
  if (document.cookie.indexOf('visitas=') === -1) {
    // Si no existe, crearla y establecer su valor en 1
    document.cookie = 'visitas=1';
  } else {
    // Si la cookie ya existe, obtiene su valor y lo convierte a un número
    const visitas = parseInt(getCookie('visitas'));

    // Incrementar el valor en 1
    document.cookie = 'visitas=' + (visitas + 1);
  }

  // Función para obtener el valor de una cookie por su nombre
  function getCookie(nombre) {
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
      const cookie = cookies[i].trim();
      if (cookie.startsWith(nombre + '=')) {
        return cookie.substring(nombre.length + 1);
      }
    }
    return '';
  }

  // Validaciones
  function validarNombre() {
    let nombre = nombreInput.value;

    if (nombre.length === 0) {
      aplicarEstiloError(nombreInput);
      errorNombre.textContent = "Error: Este campo es necesario";
    } else if (!/^[A-Za-z\s]+$/.test(nombre)) {
      aplicarEstiloError(nombreInput);
      errorNombre.textContent = "El nombre no puede contener números ni caracteres especiales";
    } else {
      quitarEstiloError(nombreInput);
      errorNombre.textContent = "";
    }
  }

  function validarDomicilio() {
    let domicilio = domicilioInput.value;

    if (domicilio.length === 0) {
      aplicarEstiloError(domicilioInput);
      errorDomicilio.textContent = "Error: Este campo es necesario";
    } else {
      quitarEstiloError(domicilioInput);
      errorDomicilio.textContent = "";
    }
  }

  function validarDNI() {
    let DNI = DNIInput.value;
    let DNIPattern = /^[0-9]{8}[A-Z]{1}$/;

    if (DNI.length === 0) {
      aplicarEstiloError(DNIInput);
      errorDNI.textContent = "Error: Este campo es necesario";
    } else if (!DNIPattern.test(DNI)) {
      aplicarEstiloError(DNIInput);
      errorDNI.textContent = "Error: DNI no válido. El formato es: 12345678A";
    } else {
      quitarEstiloError(DNIInput);
      errorDNI.textContent = "";
    }
  }

  function validarTelefono() {
    let tel = telInput.value;

    if (tel.length === 0) {
      aplicarEstiloError(telInput);
      errorTel.textContent = "Error: Este campo es necesario";
    } else if (!/^\d{9}$/.test(tel)) {
      aplicarEstiloError(telInput);
      errorTel.textContent = "Error: Debe tener 9 dígitos. El formato es: 555555555";
    } else {
      quitarEstiloError(telInput);
      errorTel.textContent = "";
    }
  }

  function validarEmail() {
    let email = emailInput.value;
    let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (email.length === 0) {
      aplicarEstiloError(emailInput);
      errorEmail.textContent = "Error: Este campo es necesario";
    } else if (!emailPattern.test(email)) {
      aplicarEstiloError(emailInput);
      errorEmail.textContent = "Error: Email no válido";
    } else {
      quitarEstiloError(emailInput);
      errorEmail.textContent = "";
    }
  }

  function validarCIF() {
    let CIF = CIFInput.value;
    let CIFPattern = /^[A-Z]{1}[0-9]{7}[A-Z]{1}$/;

    if (CIF.length === 0) {
      aplicarEstiloError(CIFInput);
      errorCIF.textContent = "Error: Este campo es necesario";
    } else if (!CIFPattern.test(CIF)) {
      aplicarEstiloError(CIFInput);
      errorCIF.textContent = "Error: CIF no válido";
    } else {
      quitarEstiloError(CIFInput);
      errorCIF.textContent = "";
    }
  }

  function validarNIFGerente() {
    let NIFGerente = NIFGerenteInput.value;
    let NIFPattern = /^[0-9]{8}[A-Z]{1}$/;

    if (NIFGerente.length === 0) {
      aplicarEstiloError(NIFGerenteInput);
      errorNIF_gerente.textContent = "Error: Este campo es necesario";
    } else if (!NIFPattern.test(NIFGerente)) {
      aplicarEstiloError(NIFGerenteInput);
      errorNIF_gerente.textContent = "Error: NIF del gerente no válido";
    } else {
      quitarEstiloError(NIFGerenteInput);
      errorNIF_gerente.textContent = "";
    }
  }

  function guardarDatosFormularioEnLocalStorage() {
    let nombre = nombreInput.value;
    let domicilio = domicilioInput.value;
    let DNI = DNIInput.value;
    let tel = telInput.value;
    let email = emailInput.value;
    let CIF = CIFInput.value;
    let NIFGerente = NIFGerenteInput.value;

    // Guardar los datos en un objeto
    let formData = {
      nombre: nombre,
      domicilio: domicilio,
      DNI: DNI,
      tel: tel,
      email: email,
      CIF: CIF,
      NIFGerente: NIFGerente
    };

    // Convertir el objeto a una cadena JSON
    let formDataJSON = JSON.stringify(formData);

    // Almacenar la cadena JSON en el almacenamiento local
    localStorage.setItem("formData", formDataJSON);
  }

  function cargarDatosFormularioDesdeLocalStorage() {
    // Obtener la cadena JSON almacenada en el almacenamiento local
    let formDataJSON = localStorage.getItem("formData");

    if (formDataJSON) {
      // Parsear la cadena JSON a un objeto
      let formData = JSON.parse(formDataJSON);

      // Llenar los campos del formulario con los datos cargados
      nombreInput.value = formData.nombre;
      domicilioInput.value = formData.domicilio;
      DNIInput.value = formData.DNI;
      telInput.value = formData.tel;
      emailInput.value = formData.email;
      CIFInput.value = formData.CIF;
      NIFGerenteInput.value = formData.NIFGerente;
    }
  }
  let botonRandom = document.getElementById("random");
  botonRandom.addEventListener("click", function(event) {
      event.preventDefault(); // Evitar la actualización de la página por defecto
      generarDNIAleatorio();
      generarNombreAleatorio();
  });
  
  function generarDNIAleatorio() {
      // Generar 8 números aleatorios entre 0 y 9
      const numerosAleatorios = Array.from({ length: 8 }, () => Math.floor(Math.random() * 10)).join('');
    
      // Generar una letra mayúscula aleatoria
      const letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      const letraAleatoria = letras.charAt(Math.floor(Math.random() * letras.length));
    
      // Combinar los números y la letra aleatoria para formar el DNI
      const dniAleatorio = numerosAleatorios + letraAleatoria;
    
      // Establecer el DNI aleatorio generado en el campo de entrada DNI
      DNIInput.value = dniAleatorio;
  }

  let nombres = ["Noah", "Josep", "Vicent"];

  function generarNombreAleatorio() {
      // Obtener un índice aleatorio del array de nombres
      let indiceAleatorio = Math.floor(Math.random() * nombres.length);
    
      // Obtener el nombre aleatorio del array
      let nombreAleatorio = nombres[indiceAleatorio];
    
      // Establecer el nombre aleatorio generado en el campo de entrada "nombre"
      nombreInput.value = nombreAleatorio;
  }
  
});

