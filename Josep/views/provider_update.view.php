<?php
session_start();
$token = bin2hex(random_bytes(24));
$_SESSION["token"] = $token;
$id = $_GET['id']??"";
?>
<div class="container">
    <h1>Actualize sus datos</h1>
    <form action="../provider_update_process.php?id=<?=$id ?>" id="form-control" method="post" novalidate="novalidate">

        <input type="hidden" id="token" name="csrf_token" value="<?= $token ?>">

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?= $provider->getEmail() ?>" required><span id="emailError" class="error"></span>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" value="<?= $provider->getPhone() ?>" required><span id="phoneError" class="error"></span>
        </div>
        <div class="form-group">
            <label for="dni">DNI:</label>
            <input type="text" name="dni" id="dni" value="<?= $provider->getDni() ?>" required><span id="dniError" class="error"></span>
        </div>
        <div class="form-group">
            <label for="cif">CIF:</label>
            <input type="text" name="cif" id="cif" value="<?= $provider->getCif() ?>" required><span id="cifError" class="error"></span>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" value="<?= $provider->getAddress() ?>" required><span id="addressError" class="error"></span>
        </div>
        <div class="form-group">
            <label for="bankTitle">Bank Title:</label>
            <input type="text" name="bankTitle" id="bankTitle" value="<?= $provider->getBankTitle() ?>" required><span id="bankTitleError" class="error"></span>
        </div>
        <div class="form-group">
            <label for="managerNIF">Manager NIF:</label>
            <input type="text" name="managerNIF" id="managerNIF" value="<?= $provider->getManagerNIF() ?>" required><span id="managerNIFError" class="error"></span>
        </div>
        <div class="form-group">
            <label for="LOPDdoc">LOPD Document:</label>
            <input type="text" name="LOPDdoc" id="LOPDdoc" value="<?= $provider->getLOPDdoc() ?>" required><span id="LOPDdocError" class="error"></span>
        </div>
        <div class="form-group">
            <label for="constitutionArticle">Constitution Article:</label>
            <input type="text" name="constitutionArticle" id="constitutionArticle" value="<?= $provider->getConstitutionArticle() ?>" required><span id="constitutionArticleError" class="error"></span>
        </div>
        <div class="form-group">
            <button type="submit">Actualizar</button>
        </div>
    </form>
</div>