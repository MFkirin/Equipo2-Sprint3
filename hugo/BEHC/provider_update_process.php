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
    echo "Error: $errorMessage";
    exit;
}

// Verificar si s'ha enviat el formulari de confirmació
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtindre l'ID del login a editar
    $idToUpdate = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    // Verificar si l'ID és vàlid abans d'intentar editar
    if ($idToUpdate !== false) {
        // Obtindre el login per ID
        $providerToUpdate = $providerRepository->find($idToUpdate);

        // Verificar si s'ha trobat el login abans d'intentar editar
        if ($providerToUpdate !== null) {

            $errors = [];
            $validator = new ProviderValidator();

            $newProviderArray = [
                "id" => $idToUpdate,
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

            if (empty(array_filter($errors))) {
                try {
                    $providerRepository->update($newProvider);

                    // Redirigir a login_list.php després de l'edició
                    header("Location: /provider_list.php");
                    exit;
                } catch (Exception $exception) {
                    echo "Error en inserir les dades del proveïdor: " . $exception->getMessage();
                }
            } else {
                var_dump($providerToUpdate);
                var_dump($errors);
            }
        } else {
            // Gestionar el cas en què el login no es troba
            header("Location: /provider_list.php?error=Proveïdor no trobat");
            exit;
        }
    } else {
        // Gestionar el cas en què l'ID no és un enter vàlid
        header("Location: /provider_list.php?error=ID no vàlid");
        exit;
    }
} else {
    // Si no s'ha enviat el formulari, redirigir a login_list.php
    header("Location: /provider_list.php");
    exit;
}