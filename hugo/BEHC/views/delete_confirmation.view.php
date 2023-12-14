<section>
    <h2>Confirmar Eliminación</h2>

    <p>¿Estás seguro de que deseas eliminar este login?</p>

    <form action="/login_delete_process.php" method="post">
        <!-- Incluir el ID del login a eliminar como un campo oculto -->
        <input type="hidden" name="id" value="<?= $providerToDelete->getId(); ?>">
        <table>
            <tr>
                <th>Nombre de usuario</th>
                <th>Password</th>
                <th>Rol</th>
            </tr>
            <tr>
                <td><?= $providerToDelete->getUsername() ?></td>
                <td><?= $providerToDelete->getPassword() ?></td>
                <td><?= $providerToDelete->getRole() ?></td>
            </tr>
        </table>

        <button type="submit">Confirmar Eliminación</button>
    </form>
    <form action="/login_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>
