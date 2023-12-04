<h2>Resultados del Formulario</h2>
<div>
     <?php if (empty($errors)) :?>

        <h3>L'usuari s'ha creat correctament</h3>

    <?php else :?>
        <h3>Hi ha els següents errors:</h3>
     <ul>
         <?php foreach ($errors as $error) :?>
            <li><?=$error?></li>
         <?php endforeach;?>
     </ul>

    <?php endif ?>


    <a href="../index.php">Tornar al inici</a>
    <a href="../provider_list.php">Mostrar todos los empleados</a>
</div>
