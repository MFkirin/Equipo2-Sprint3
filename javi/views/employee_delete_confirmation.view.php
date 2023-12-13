<section>
    <h2>Confirmar Eliminación</h2>

    <p>¿Estás seguro de que deseas eliminar este employee?</p>

    <form action="/employee_delete_process.php" method="post">
        <!-- Incluir el ID del login a eliminar como un campo oculto -->
        <input type="hidden" name="id" value="<?= $employeeToDelete->getId(); ?>">
        <table>
            <tr>
                <th>Nombre de usuario</th>
                <th>Apellido</th>
                <th>Tipo</th>
            </tr>
            <tr>
                <td><?= $employeeToDelete->getName() ?></td>
                <td><?= $employeeToDelete->getLastname() ?></td>
                <td><?= $employeeToDelete->getType() ?></td>
            </tr>
        </table>

        <button type="submit">Confirmar Eliminación</button>
    </form>
    <form action="/employee_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>
