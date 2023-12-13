<?php
require_once __DIR__ . '/vendor/autoload.php';
$config = require __DIR__ . '/config/config.php';

use App\Core\Database;
use App\Core\Security;
use App\Core\View;
use App\Entity\Provider;
use App\Repository\ProviderRepository;

session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdministrator($token);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    /*$token = $_POST["csrf_token"];
    $nombre = $_POST['name'];
    $tipo = $_POST['role'];
    $contrasena = $_POST['password'];
*/
    $id = $_POST["id"] ?? "";
    try {
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

echo View::render('provider_delete_process', 'backoffice', ['id'=>$id]);