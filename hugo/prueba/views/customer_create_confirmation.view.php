
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="titol">
                <h1>Professional</h1>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
            <form id="form-control" action="/customer_create_process.php" method="post" onsubmit="return validateForm()" novalidate>
                <div class="form-group">
                    <label for="name">Nom:</label>
                    <input type="text" id="name" name="name" pattern="^[a-zA-Z ]{0,25}$">
                </div>

                <div class="form-group">
                    <label for="lastname">Cognoms:</label>
                    <input type="text" id="lastname" name="lastname" pattern="^[a-zA-Z ]{0,25}$" required>
                </div>

                <div class="form-group">
                    <label for="address">Adreça:</label>
                    <input type="text" id="address" name="address"
                           pattern="^(?=\S*\s)(?=[^a-zA-Z]*[a-zA-Z])(?=\D*\d)[a-zA-Z\d\s',.#/-]*$" required>
                </div>

                <div class="form-group">
                    <label for="dni">DNI: </label>
                    <input type="text" id="dni" name="dni" pattern="^[0-9]{8}[A-Z]$" required>
                </div>

                <div class="form-group">
                    <label for="phone">Mòbil:</label>
                    <input type="text" id="phone" name="phone" pattern="^[0-9]{9}$" required>
                </div>

                <div class="form-group">
                    <label for="bussiness_name">Nom de l'empresa:</label>
                    <input type="text" id="bussiness_name" name="bussiness_name" pattern="^[a-zA-Z ]{0,25}$" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" pattern="^[a-z0-9]+@[a-z0-9]+\.[a-z]{2,4}$"
                           required>
                </div>

                <div class="form-group">
                    <label for=username">Nom d'usuari:</label>
                    <input type="text" id="username" name="username"
                           pattern="^[a-zA-Z]{0,25}$" required>
                </div>


                <div class="form-group">
                    <label for="password">Contrasenya:</label>
                    <input type="password" id="password" name="password"
                           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$" required>
                </div>
<!--
                <div class="form-group">
                    <label for="cif">CIF:</label>
                    <input type="text" id="cif" name="cif" pattern="^[A-Za-z]{1}[0-9]{8}$" required>
                </div>

                <div class="form-group">
                    <label for="manager-nif">Manager NIF:</label>
                    <input type="text" id="manager-nif" name="manager-nif" pattern="^[0-9]{8}[A-Z]$" required>
                </div>

                <div class="form-group">
                    <label for="subscription">Subscripció: </label>
                    <input type="checkbox" id="subscription" name="subscription" required>
                </div>

                <div class="form-group">
                    <label for="constitutionWriting">Escritura constitució: </label><br>
                    <input type="file" id="constitutionWriting" name="constitutionWriting" required>
                </div>-->

                <div class="form-group">
                    <p><a href="#contraseña">Heu oblidat la contrasenya?</a></p>
                    <button type="submit" id="submit">Crear compte</button>
                    <p>No tens compte? <a href="HTMLCSS/registro.html">Registra't ara</a></p>
                </div>
            </form>

            <form action="/customer_list.php" method="get">
                <button id="submit" type="submit">Cancelar</button>
            </form>
            <!--<div class="error-message" id="errorMessage"></div>
            <div class="success-message" id="successMessage"></div>
            <div class="modal-correct" id="modal-correct">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p>Inici de sessió correcte!</p>
                </div>
            </div>

            <div class="modal-incorrect-email" id="modal-incorrect-email">
                <div class="modal-content">
                    <span class="close-email">&times;</span>
                    <p>Correu electrònic incorrecte!</p>
                </div>
            </div>

            <div class="modal-incorrect-pwd" id="modal-incorrect-pwd">
                <div class="modal-content">
                    <span class="close-pwd">&times;</span>
                    <p>La contrasenya ha de contenir almenys 8 caràcters, incloent-hi una majúscula, una
                        minúscula, un número i un dels següents caràcters especials: -_!</p>
                </div>
            </div>-->
        </div>
    </div>
</div>