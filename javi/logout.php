<?php
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';

use App\Helper\FlashMessage;

session_start();
session_unset();
session_destroy();

session_start();
FlashMessage::set("message", "S'ha tancat sessió correctament");
header('Location: index.php');
exit;


