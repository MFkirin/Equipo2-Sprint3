<?php
require __DIR__ . '/src/Core/Database.php';
require __DIR__ . '/src/Core/View.php';
require __DIR__ . '/src/Entity/Provider.php';
require __DIR__ . '/src/Repository/ProviderRepository.php';
require __DIR__ . '/src/Validator/ProviderValidator.php';

$config = require __DIR__ . '/config/config.php';

session_start();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    /*    $token = $_POST["csrf_token"];
        $nombre = $_POST['name'];
        $tipo = $_POST['role'];
        $contrasena = $_POST['password'];


        if (empty($errores) && hash_equals($_SESSION["token"], $token)) {
    */
    try {
        $email = $_POST['email'] ?? "";
        $phone = $_POST['phone'] ?? "";
        $dni = $_POST['dni'] ?? "";
        $cif = $_POST['cif'] ?? "";
        $address = $_POST['address'] ?? "";
        $bankTitle = $_POST['bankTitle'] ?? "";
        $managerNIF = $_POST['managerNIF'] ?? "";
        $LOPDdoc = $_POST['LOPDdoc'] ?? "";
        $constitutionArticle = $_POST['constitutionArticle'] ?? "";

        $database = new Database($config["database"]);
        $providerRepository = new ProviderRepository($database->getConnection(), Provider::class);

        $newProvider = new Provider();
        $newProvider->setEmail($email);
        $newProvider->setPhone($phone);
        $newProvider->setDni($dni);
        $newProvider->setCif($cif);
        $newProvider->setAddress($address);
        $newProvider->setBankTitle($bankTitle);
        $newProvider->setManagerNIF($managerNIF);
        $newProvider->setLOPDdoc($LOPDdoc);
        $newProvider->setConstitutionArticle($constitutionArticle);

        $providerValidator = new ProviderValidator();
        $errors = $providerValidator->validate($newProvider);

        if (empty($errors))
            $providerRepository->create($newProvider);
    } catch (PDOException $e) {
        $errors[] = 'Error de conexión: ' . $e->getMessage();
    } catch (Exception $e) {
        $errors[] = $e->getMessage();
    }
} else {
    $errors[] = 'No se recibieron datos del formulario';
}

echo View::render('provider_create_process', 'backoffice', ["errors" => $errors]);