<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Core\Security;
use App\Core\View;
use App\Entity\Provider;
use App\Repository\ProviderRepository;
use App\Validator\ProviderValidator;
session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);

$config = require __DIR__ . '/config/config.php';
$errors = [];
try {
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


echo View::render('provider_update_process', 'backoffice',  ["errors"=>$errors]);