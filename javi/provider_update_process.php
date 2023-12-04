<?php
session_start();

require __DIR__ . '/src/Core/Database.php';
require __DIR__ . '/src/Core/View.php';
require __DIR__ . '/src/Entity/Provider.php';
require __DIR__ . '/src/Repository/ProviderRepository.php';
require __DIR__ . '/src/Validator/ProviderValidator.php';

$config = require __DIR__ . '/config/config.php';
$errors = [];
    try {
        $token = $_POST["csrf_token"];
        $id = $_GET["id"] ?? 0;
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

        $filtredProvider = $providerRepository->find($id);
        $filtredProvider->setEmail($email);
        $filtredProvider->setPhone($phone);
        $filtredProvider->setDni($dni);
        $filtredProvider->setCif($cif);
        $filtredProvider->setAddress($address);
        $filtredProvider->setBankTitle($bankTitle);
        $filtredProvider->setManagerNIF($managerNIF);
        $filtredProvider->setLOPDdoc($LOPDdoc);
        $filtredProvider->setConstitutionArticle($constitutionArticle);

        $providerValidator = new ProviderValidator();
        $errors = $providerValidator->validate($filtredProvider);

        if (empty($errors)) {
            $providerRepository->update($filtredProvider);
        }

    } catch (PDOException $e) {
        $mensaje = 'Error de conexión: ' . $e->getMessage();
    }


echo View::render('provider_update_process', 'default',  ["errors"=>$errors]);