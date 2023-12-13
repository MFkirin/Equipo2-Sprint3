<?php
require_once __DIR__. '/src/Core/Database.php';
require_once __DIR__. '/src/Core/View.php';
require_once __DIR__. '/src/Entity/Image.php';
require_once __DIR__. '/src/Repository/ImageRepository.php';

$config = require_once __DIR__. '/config/config.php';

$database = new Database($config["database"]);
$imageRepository = new ImageRepository($database->getConnection(), Image::class);

$idToDelete = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($idToDelete !== false) {
    try {
        $imageToDelete = $imageRepository->find($idToDelete);
    } catch (RecordNotFoundException $e) {
    }

    if ($imageToDelete !== null) {
        echo View::render('image_delete_confirmation', 'default', ["imageToDelete" => $imageToDelete]);
    } else {
        header("Location: /vehicle_list.php?error=Vehicle no trobat");
        exit;
    }
} else {
    header("Location: /vehicle_list.php?error=ID no vàlid");
    exit;
}