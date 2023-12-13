document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("registroForm");
    const fields = ['nombre', 'apellido', 'correo', 'password', 'confirmPass'];
    let button = document.getElementById("cookie");
    let mostrar = document.getElementById("mostrar");
    let mostrarT = document.getElementById("mostrarT");

    button.addEventListener("click", (event) => {
        document.cookie = "prueba=HolaMundo"
        document.cookie = "prueba2=AdiosMundo"
        document.cookie = "prueba3=Naranja"
    });
    
    mostrar.addEventListener("click", (event) => {
        let ul = document.getElementById("ul");
        let li = document.createElement("li");
        let cookies = document.cookie.replace(/(?:(?:^|.*;\s*)prueba2\s*\=\s*([^;]*).*$)|^.*$/, "$1");
        ul.append(li);
        li.append(cookies);
    });

    mostrarT.addEventListener("click", (event) => {
        let ul = document.getElementById("ul");
        let li = document.createElement("li");
        let cookies = document.cookie;
        ul.append(li);
        li.append(cookies);
    });

    fields.forEach(field => {
        const inputField = document.getElementById(field);
        const errorField = document.getElementById(field + 'Error');
        inputField.addEventListener("input", function () {
            validateField(field, inputField.value, errorField, inputField);
        });
    });

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        try{ validateForm() }
        
        catch {
            alert("El formulario tiene errores. Por favor, corrígelos antes de enviarlo.");
            throw new Error("Error al validar");
        }
    });

    function validateField(fieldname, value, errorField, inputField) {
        errorField.textContent = '';
        inputField.classList.remove('error');

        switch (fieldname) {
            case 'nombre':
            case 'apellido':
                if (value.length < 1) {
                    errorField.textContent = "El " + fieldname + " no puede estar vacio";
                    inputField.classList.add('error');
                    throw new Error("El campo no puede estar vacio");
                }
                else if (!value.match(/^[A-Za-z]+$/)) {
                    errorField.textContent = "Debe contener solo letras.";
                    inputField.classList.add('error');
                    throw new Error("Debe contener solo letras");
                }
                break;
            case 'correo':
                if (!value.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
                    errorField.textContent = "Correo electrónico no válido.";
                    inputField.classList.add('error');
                    throw new Error("Correo no valido.");
                }
                break;
            case 'password':
                if (!value.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$^&*()_-]).{8,18}$/)) {
                    errorField.textContent = "Debe contener al menos una minúscula, una mayúscula, un carácter especial y un número.";
                    inputField.classList.add('error');
                    throw new Error("Formato de password incorrecto.");
                }
                break;
            case 'confirmPass':
                const passwordValue = document.getElementById('password').value;
                if (value !== passwordValue) {
                    errorField.textContent = "Las contraseñas no coinciden.";
                    inputField.classList.add('error');
                    throw new Error("Los password no coinciden.");
                }
                break;
            default:
                break;
        }
    }

    function validateForm() {
        const fields = ['nombre', 'apellido','correo', 'password', 'confirmPass'];
        let isValid = true;

        fields.forEach(field => {
            const inputField = document.getElementById(field);
            const errorField = document.getElementById(field + 'Error');
            validateField(field, inputField.value, errorField, inputField);
            if (errorField.textContent !== '') {
                isValid = false;
            }
        });
        return isValid;
    }
    
    var btnModal = document.getElementById("btnModal");
    var sendButton = document.getElementById("aceptar");
    var closeModalButton = document.getElementById("cancelar");
    var modal = document.getElementById("myModal");
    btnModal.addEventListener('click', function() {
        modal.style.display = "block";
      });
    // Mostrar el modal cuando se hace clic en el botón "Aceptar"
    sendButton.addEventListener('click', function() {
      modal.style.display = "none";
      if(validateForm()){
        form.submit();}
    });
    
    // Cerrar el modal cuando se hace clic en el botón "Cerrar"
    closeModalButton.addEventListener('click', function() {
      modal.style.display = "none";
    });
    
    // Cerrar el modal cuando se hace clic fuera de él
    window.addEventListener('click', function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    });



    var btnModalSweet = document.getElementById("btnModalSweet");
    btnModalSweet.addEventListener("click",mostrarSweet);


    function mostrarSweet(){
        Swal.fire({
            title: 'Confirma!',
            text: 'Esta seguro de querer enviar la información?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Cool',
            cancelButtonText: 'Cancelar'
          })
          .then((result) => {
            if (result.isConfirmed) {
               console.log('Se ha confirmado el Sweet Alert');
               if(validateForm()){
               form.submit();}
            } else if (result.dismiss === Swal.DismissReason.cancel) { 
               console.log('Se ha cancelado el Sweet Alert');
            }
         })
    }
});
//localStorage.getItem(nombre[0])
