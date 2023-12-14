<section>
    <h2>Creación de employee</h2>

    <form action="../employee_create_process.php" method="post" novalidate onsubmit="return validateForm()">
        <label for="name">Nom: </label>
        <input type="text" id="name" name="name">

        <label for="lastname">Cognoms: </label>
        <input type="text" id="lastname" name="lastname">

        <label for="type">Rol: </label>
        <select id="type" name="type">
            <option value="administrator">Administrator</option>
            <option value="administrative">Administrative</option>
        </select>

        <label for="username">Usuari: </label>
        <input type="text" name="username" id="username">

        <label for="password">Contrasenya: </label>
        <input type="password" name="password" id="password">

        <button type="submit">Crear</button>

    </form>

    <form action="../employee_list.php" method="get">
        <button type="submit">Cancelar</button>
    </form>
</section>