<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="edicio">
                <h2>Edició del client</h2>
            </div>

            <form id="form-control" action="/customer_update_process.php" method="post">
                <!-- Incluir el ID del login a editar como un campo oculto -->
                <input type="hidden" name="id" value="<?= $customerToUpdate->getId(); ?>">

                <!-- Agregar campos para editar la información del login -->
                <div class="form-group">
                    <label for="name">Nom:</label>
                    <input type="text" id="name" name="name" value="<?= $customerToUpdate->getName(); ?>" pattern="^[a-zA-Z ]{0,25}$">
                </div>

                <div class="form-group">
                    <label for="lastname">Cognoms:</label>
                    <input type="text" id="lastname" name="lastname" value="<?= $customerToUpdate->getLastname(); ?>" pattern="^[a-zA-Z ]{0,25}$" required>
                </div>

                <div class="form-group">
                    <label for="address">Adreça:</label>
                    <input type="text" id="address" name="address" value="<?= $customerToUpdate->getAddress(); ?>"
                           pattern="^(?=\S*\s)(?=[^a-zA-Z]*[a-zA-Z])(?=\D*\d)[a-zA-Z\d\s',.#/-]*$" required>
                </div>

                <div class="form-group">
                    <label for="dni">DNI: </label>
                    <input type="text" id="dni" name="dni" value="<?= $customerToUpdate->getDni(); ?>" pattern="^[0-9]{8}[A-Z]$" required>
                </div>

                <div class="form-group">
                    <label for="phone">Mòbil:</label>
                    <input type="text" id="phone" name="phone" pattern="^[0-9]{9}$" value="<?= $customerToUpdate->getPhone(); ?>" required>
                </div>

                <div class="form-group">
                    <label for="bussiness_name">Nom de l'empresa:</label>
                    <input type="text" id="bussiness_name" name="bussiness_name" value="<?= $customerToUpdate->getBusinessName(); ?>" pattern="^[a-zA-Z ]{0,25}$"
                           required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= $customerToUpdate->getEmail(); ?>" pattern="^[a-z0-9]+@[a-z0-9]+\.[a-z]{2,4}$"
                           required>
                </div>

                <div class="form-group">
                    <button type="submit" id="submit">Actualitzar</button>
                </div>
            </form>

            <form action="/customer_list.php" method="get">
                <button id="submit" type="submit">Cancelar</button>
            </form>
        </div>
    </div>
</div>