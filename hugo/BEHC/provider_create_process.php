<?php


require __DIR__ . '/src/Core/Database.php';
require __DIR__ . '/src/Core/View.php';
require __DIR__ . '/src/Entity/Provider.php';
require __DIR__ . '/src/Repository/ProviderRepository.php';
require __DIR__ . '/src/Validator/ProviderValidator.php';

$config = require __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$providerRepository = new ProviderRepository($database->getConnection(), Provider::class);

// Comprovar si hi ha un paràmetre d'error a la URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    // TODO: Cal buscar una alternativa a aquest echo
    echo "Error: $errorMessage";
    exit;
}

// Verificar si s'ha enviat el formulari de confirmació
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $errors = [];
    $validator = new ProviderValidator();

    $newProviderArray = [
        "id" => 0,
        'address' => $_POST['completeAddress'],
        'dni' => $_POST['dni'],
        'phone' => $_POST['phone'],
        'email' => $_POST['email'],
        'cif' => $_POST['CIF'],
        'managerNIF' => $_POST['managerNIF'],
        'constitutionArticle' => $_POST['constitutionArticle'],
        'LOPDdoc' => $_POST['LOPDdoc'],
        'bankTitle' => $_POST['bankTitle'],
    ];

    $newProvider = Provider::fromArray($newProviderArray);
    $errors = $validator->validate($newProvider);

    if (empty($errors)) {
        try {
            $providerRepository->create($newProvider);

            // Redirigir a login_list.php després de la creació exitosa
            header("Location: /provider_list.php");
            exit;
        } catch (Exception $exception) {
            // Redirigir a la pàgina de creació amb missatge d'error
            header("Location: /provider_create.php?error=" . urlencode("Error en insertar les dades del proveïdor: " . $exception->getMessage()));
            exit;
        }
    } else {
        // Redirigir a la pàgina de creació amb missatges d'error
        $errorMessages = implode(', ', $errors);

        // TODO: millor usar variables de sessió per a la comunicació entre pàgines (controladors)
        header("Location: /provider_create.php?error=" . urlencode("Errors de validació: $errorMessages"));
        exit;
    }
} else {
    // Gestionar el cas en què el login no es troba
    header("Location: /provider_list.php?error=Proveedor no trobat");
    exit;
}
