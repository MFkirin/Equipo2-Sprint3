<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Core\View;
use App\Entity\Image;
use App\Exception\RecordNotFoundException;
use App\Repository\ImageRepository;

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