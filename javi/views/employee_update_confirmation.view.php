<section>
    <h2>Edición de login</h2>

    <form action="/employee_update_process.php" method="post">
        <!-- Incluir el ID del login a editar como un campo oculto -->
        <input type="hidden" id="id" name="id" value="<?= $employeeToUpdate->getId(); ?>">

        <!-- Agregar campos para editar la información del login -->
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="name" name="name" value="<?= $employeeToUpdate->getName(); ?>" required>

        <label for="lastname">Apellido:</label>
        <input type="text" id="lastname" name="lastname" value="<?=$employeeToUpdate->getLastName();?>" required>

        <select id="type" name="type" required>

            <option value="administrator" <?= ($employeeToUpdate->getType() === 'administrator') ? 'selected' : ''; ?>>
                Administrator
            </option>
            <option value="administrative" <?= ($employeeToUpdate->getType() === 'administrative') ? 'selected' : ''; ?>>
                Administrative
            </option>
        </select>

        <button type="submit">Actualizar</button>
    </form>

    <form action="/employee_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>