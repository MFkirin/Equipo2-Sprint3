<section>
    <h2>Creación de login</h2>
    <?php use App\Helper\FlashMessage;

    if (isset($_SESSION["flash-message"]["message"])) {
        echo '<p class="message">' . $_SESSION["flash-message"]["message"] . '</p>';
        FlashMessage::unset("message");
    } ;?>
    <form action="/login_create_process.php" method="post">

        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" required minlength="3" pattern="[A-Za-z0-9]+"
               title="Solo se permiten caracteres alfanuméricos">

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required minlength="8" pattern="^(?=.*[A-Za-z])(?=.*\d).*$"
               title="Debe tener al menos una letra y un número">

        <!-- Botón para revelar la contraseña -->
        <button type="button" id="showPassword" onclick="showHidePassword()">Mostrar Contraseña</button>

        <select id="role" name="role" required>
            <option value="customer">Customer</option>
            <option value="employee">Employee</option>
            <option value="private">Private</option>
            <option value="professional">Professional</option>
            <option value="administrator">Administrator</option>
            <option value="administrative">Administrative</option>
        </select>

        <button type="submit">Crear</button>
    </form>

    <form action="/login_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>