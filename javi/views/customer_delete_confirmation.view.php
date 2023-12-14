<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Confirmar Eliminación</h2>

            <p>Estàs segur que desitges eliminar aquest client?</p>

            <form action="/customer_delete_process.php" method="post">
                <!-- Incluir el ID del login a eliminar como un campo oculto -->
                <input type="hidden" name="id" value="<?= $customerToDelete->getId(); ?>">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Cognoms</th>
                        <th>Adreça</th>
                        <th>DNI</th>
                        <th>Mòbil</th>
                        <th>Nom d'empresa</th>
                        <th>Email</th>
                    </tr>
                    <tr>
                        <td><?= $customerToDelete->getId() ?></td>
                        <td><?= $customerToDelete->getName() ?></td>
                        <td><?= $customerToDelete->getLastname() ?></td>
                        <td><?= $customerToDelete->getAddress() ?></td>
                        <td><?= $customerToDelete->getDni() ?></td>
                        <td><?= $customerToDelete->getPhone() ?></td>
                        <td><?= $customerToDelete->getBusinessName() ?></td>
                        <td><?= $customerToDelete->getEmail() ?></td>
                    </tr>
                </table>

                <button type="submit">Confirmar Eliminació</button>
            </form>
            <form action="/customer_list.php" method="get">
                <button type="submit">Cancelar</button>
            </form>
        </div>
    </div>
</div>
