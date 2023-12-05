<?php

require __DIR__ . '/src/Core/Database.php';
require __DIR__ . '/src/Entity/Provider.php';
require __DIR__ . '/src/Repository/ProviderRepository.php';

$config = require __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$providerRepository = new ProviderRepository($database->getConnection(), Provider::class);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idToDelete = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($idToDelete !== false) {
        $providerToDelete = $providerRepository->find($idToDelete);

        if ($providerToDelete !== null) {
            $providerRepository->delete($providerToDelete);


            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => 'Proveedor no encontrado']);
            exit;
        }
    } else {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'ID no válido']);
        exit;
    }
} else {
    // Manejar casos donde el método de solicitud no es POST
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no permitido']);
    exit;
}
