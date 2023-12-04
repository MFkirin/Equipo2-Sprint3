<?php
require __DIR__ . '/src/Core/Database.php';
require __DIR__ . '/src/Core/View.php';
require __DIR__ . '/src/Entity/Provider.php';
require __DIR__ . '/src/Repository/ProviderRepository.php';

$config = require __DIR__ . '/config/config.php';
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    /*$token = $_POST["csrf_token"];
    $nombre = $_POST['name'];
    $tipo = $_POST['role'];
    $contrasena = $_POST['password'];


    if (empty($errores) && hash_equals($_SESSION["token"], $token)) { */

        try {
            $token = $_POST["csrf_token"];
            $id = $_GET["id"] ?? "";

            $database = new Database($config["database"]);
            $providerRepository = new ProviderRepository($database->getConnection(), Provider::class);

            $filtredProvider = $providerRepository->find($id);
            $providerRepository->delete($filtredProvider);

        } catch (PDOException $e) {
            $mensaje = 'Error de conexión: ' . $e->getMessage();
        }
    } else {
        $mensaje = 'No se recibieron datos del formulario';
    }

echo View::render('provider_delete_process', 'default', ['id'=>$id]);