<?php

require __DIR__ . '/src/Helper/FlashMessage.php';

session_start();
session_unset();
session_destroy();

session_start();
FlashMessage::set("message", "S'ha tancat sessió correctament");
header('Location: login.php');
exit;


