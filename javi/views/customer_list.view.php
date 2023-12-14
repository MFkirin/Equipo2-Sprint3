<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="sessio">
                    <h2>Inicis de sessió</h2>
                </div>
                <div class="button-nou-client">
                    <a href="/customer_create.php">
                        <button type="button" class="create-customer-button">Crear Nou Client</button>
                    </a>
                </div>
                <form>
                    <label for="searchInput">Cercador: </label>
                    <input type="text" id="searchInput" placeholder="Buscar por nombre de usuario">
                </form>
                <table id="table-control">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Cognoms</th>
                        <th>Adreça</th>
                        <th>DNI</th>
                        <th>Mòbil</th>
                        <th>Nom d'empresa</th>
                        <th>Email</th>
                        <th colspan="2">Operacions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?= $customer->getId() ?></td>
                            <td><?= $customer->getName() ?></td>
                            <td><?= $customer->getLastname() ?></td>
                            <td><?= $customer->getAddress() ?></td>
                            <td><?= $customer->getDni() ?></td>
                            <td><?= $customer->getPhone() ?></td>
                            <td><?= $customer->getBusinessName() ?></td>
                            <td><?= $customer->getEmail() ?></td>
                            <td><a href="/customer_update.php?id=<?= $customer->getId(); ?>" class="operation-link edit-link">Editar</a>
                            </td>
                            <td><button type="submit" formaction="/customer_delete.php" class="operation-link delete-link">Eliminar</button></td>

                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <canvas id="chart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</section>