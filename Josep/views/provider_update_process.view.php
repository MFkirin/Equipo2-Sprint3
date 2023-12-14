
<h2>Actualització del usuari</h2>
<div>
    <?php if (empty($errors)) :?>
        <h3>L'usuari s'ha actualitzat correctament</h3>
    <?php else :?>
    <h3>Hi ha els següents errors:</h3>
        <ul>
            <?php foreach ($errors as $error) :?>
                <li><?=$error?></li>
            <?php endforeach;?>
        </ul>

    <?php endif ?>

    <h2><a href="../provider_list.php">Tornar l'inici</a></h2>
</div>
