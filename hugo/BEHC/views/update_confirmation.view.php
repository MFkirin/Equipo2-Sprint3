<section>
    <h2>Edición de login</h2>

    <form action="/login_update_process.php" method="post">
        <!-- Incluir el ID del login a editar como un campo oculto -->
        <input type="hidden" name="id" value="<?= $providerToUpdate->getId(); ?>">

        <!-- Agregar campos para editar la información del login -->
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" value="<?= $providerToUpdate->getUsername(); ?>" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <select id="role" name="role" required>
            <option value="customer" <?= ($providerToUpdate->getRole() === 'customer') ? 'selected' : ''; ?>>Customer
            </option>
            <option value="employee" <?= ($providerToUpdate->getRole() === 'employee') ? 'selected' : ''; ?>>Employee
            </option>
            <option value="private" <?= ($providerToUpdate->getRole() === 'private') ? 'selected' : ''; ?>>Private</option>
            <option value="professional" <?= ($providerToUpdate->getRole() === 'professional') ? 'selected' : ''; ?>>
                Professional
            </option>
            <option value="administrator" <?= ($providerToUpdate->getRole() === 'administrator') ? 'selected' : ''; ?>>
                Administrator
            </option>
            <option value="administrative" <?= ($providerToUpdate->getRole() === 'administrative') ? 'selected' : ''; ?>>
                Administrative
            </option>
        </select>

        <button type="submit">Actualizar</button>
    </form>

    <form action="/login_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>