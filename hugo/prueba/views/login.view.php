<section>
    <h2>Creación de login</h2>

    <form action="/login.php" method="post" novalidate>

        <!--<p>L'Usuari és incorrecte incorrecte </p>-->

        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" required minlength="3" pattern="[A-Za-z0-9]+"
               title="Solo se permiten caracteres alfanuméricos">

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required minlength="8" pattern="^(?=.*[A-Za-z])(?=.*\d).*$"
               title="Debe tener al menos una letra y un número">
        <button type="submit">Iniciar Sessió</button>
    </form>

    <form action="/login_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>