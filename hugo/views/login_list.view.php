<section>
    <h2>Inicis de sessió</h2>
    <a href="/login_create.php">
        <button type="button" class="create-login-button">Crear Nuevo Login</button>
    </a>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom d'usuari</th>
            <th>Contrasenya</th>
            <th>Rol</th>
            <th colspan="2">Operacions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($logins as $login): ?>
            <tr>
                <td><?= $login->getId() ?></td>
                <td><?= $login->getUsername() ?></td>
                <td><?= $login->getPassword() ?></td>
                <td><?= $login->getRole() ?></td>
                <td><a href="/login_update.php?id=<?= $login->getId(); ?>" class="operation-link edit-link">Editar</a>
                </td>
                <td><a href="/login_delete.php?id=<?= $login->getId(); ?>"
                       class="operation-link delete-link">Eliminar</a></td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</section>
