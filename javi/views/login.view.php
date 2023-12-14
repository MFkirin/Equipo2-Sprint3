<section>
    <h2>Inicio de sesión</h2>


    <?php  if (!empty($message)) :?>
        <p class="message"><?=$message?></p>
    <?php endif; ?>

    <form action="/login.php" method="post" novalidate>

        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" required minlength="3" pattern="[A-Za-z0-9]+"
               title="Solo se permiten caracteres alfanuméricos" value="carlos">

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required minlength="8" pattern="^(?=.*[A-Za-z])(?=.*\d).*$"
               title="Debe tener al menos una letra y un número" value="carlos">
        <button type="submit">Iniciar Sessió</button>
    </form>
    <a href="index.php">
        <button>Cancelar</button>
    </a>
</section>