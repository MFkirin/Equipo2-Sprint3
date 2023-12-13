<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Core\View;
use App\Core\Database;
use App\Entity\Login;
use App\Repository\LoginRepository;
use App\Core\Security;
use App\Helper\FlashMessage;

session_start();

$config = require_once __DIR__ . '/config/config.php';

$database = new Database($config["database"]);
$loginRepository = new LoginRepository($database->getConnection(), Login::class);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";
    try {
        Security::login($username, $password, $loginRepository);

        header('Location: index.php');
        exit;
    } catch (Exception $e) {
        FlashMessage::set("message", $e->getMessage());
        header('Location: login.php');
        exit;
    }
}

echo View::render('login');