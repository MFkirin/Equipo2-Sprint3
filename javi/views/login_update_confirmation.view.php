<section>
    <h2>Edición de login</h2>
    <?php use App\Helper\FlashMessage;

    if (isset($_SESSION["flash-message"]["message"])) {
        echo '<p class="message">' . $_SESSION["flash-message"]["message"] . '</p>';
        FlashMessage::unset("message");
    }; ?>
    <form action="/login_update_process.php" method="post">
        <!-- Incluir el ID del login a editar como un campo oculto -->
        <input type="hidden" name="id" value="<?= $loginToUpdate->getId(); ?>">

        <!-- Agregar campos para editar la información del login -->
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" value="<?= $loginToUpdate->getUsername(); ?>" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <!-- Botón para revelar la contraseña -->
        <button type="button" id="showPassword" onclick="showHidePassword()">Mostrar Contraseña</button>

        <select id="role" name="role" required>
            <option value="customer" <?= ($loginToUpdate->getRole() === 'customer') ? 'selected' : ''; ?>>Customer
            </option>
            <option value="employee" <?= ($loginToUpdate->getRole() === 'employee') ? 'selected' : ''; ?>>Employee
            </option>
            <option value="private" <?= ($loginToUpdate->getRole() === 'private') ? 'selected' : ''; ?>>Private</option>
            <option value="professional" <?= ($loginToUpdate->getRole() === 'professional') ? 'selected' : ''; ?>>
                Professional
            </option>
            <option value="administrator" <?= ($loginToUpdate->getRole() === 'administrator') ? 'selected' : ''; ?>>
                Administrator
            </option>
            <option value="administrative" <?= ($loginToUpdate->getRole() === 'administrative') ? 'selected' : ''; ?>>
                Administrative
            </option>
        </select>

        <button type="submit">Actualizar</button>
    </form>

    <form action="/login_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>