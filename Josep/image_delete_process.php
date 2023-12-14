<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\Database;
use App\Entity\Image;
use App\Repository\ImageRepository;

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$imageRepository = new ImageRepository($database->getConnection(), Image::class);

if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo "Error: $errorMessage";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idToDelete = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($idToDelete !== false) {
        $imageToDelete = $imageRepository->find($idToDelete);

        if ($imageToDelete) {
            $imageRepository->delete($imageToDelete);
            header("Location: /vehicle_list.php");
            exit;
        } else {
            header("Location: /vehicle_list.php?error=Vehicle no trobat");
            exit;
        }
    } else {
        header("Location: /vehicle_list.php?error=ID no vàlid");
        exit;
    }
} else {
    header("Location: /vehicle_list.php");
    exit;
}