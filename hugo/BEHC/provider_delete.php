<?php
require __DIR__ . '/src/Core/Database.php';
require __DIR__ . '/src/Core/View.php';
require __DIR__ . '/src/Entity/Provider.php';
require __DIR__ . '/src/Repository/ProviderRepository.php';

$config = require __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$providerRepository = new ProviderRepository($database->getConnection(), Provider::class);

// Obtindre l'ID del login des de la URL
$idToDelete = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// Verificar si l'ID és vàlid abans d'intentar eliminar
if ($idToDelete !== false) {
    // Obtindre el login per ID
    try {
        $providerToDelete = $providerRepository->find($idToDelete);
    } catch (RecordNotFoundException $e) {
    }

    // Verificar si s'ha trobat el login abans de mostrar la vista de confirmació
    if ($providerToDelete !== null) {
        echo View::render('provider_delete_confirmation', 'default', ["providerToDelete" => $providerToDelete]);
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