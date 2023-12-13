<?php
session_start();
$token = bin2hex(random_bytes(24));
$_SESSION["token"] = $token;
?>
<div class="container">
    <h1>Estas segur d'eliminar el login?</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Email</th>
                <th>Phone</th>
                <th>DNI</th>
                <th>CIF</th>
                <th>Address</th>
                <th>Bank Title</th>
                <th>Manager NIF</th>
                <th>LOPD Document</th>
                <th>Constitution Article</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $provider->getId() ?></td>
                <td><?= $provider->getEmail() ?></td>
                <td><?= $provider->getPhone() ?></td>
                <td><?= $provider->getDni() ?></td>
                <td><?= $provider->getCif() ?></td>
                <td><?= $provider->getAddress() ?></td>
                <td><?= $provider->getBankTitle() ?></td>
                <td><?= $provider->getManagerNIF() ?></td>
                <td><?= $provider->getLOPDdoc() ?></td>
                <td><?= $provider->getConstitutionArticle() ?></td>
            </tr>
        </tbody>
    </table>
    <h2><a href="../provider_delete_process.php?id=<?= $provider->getId() ?>">Sí</a></h2>
    <h2><a href="../provider_list.php">Sortir</a></h2>
</div>