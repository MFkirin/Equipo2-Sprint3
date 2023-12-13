<?php

require_once __DIR__ . '/src/Core/Database.php';
require_once __DIR__ . '/src/Core/View.php';
require_once __DIR__ . '/src/Entity/Provider.php';
require_once __DIR__ . '/src/Repository/ProviderRepository.php';
require_once __DIR__ . '/src/Core/Security.php';
require_once __DIR__ . '/src/Helper/FlashMessage.php';

session_start();

$token = Security::getToken();
Security::isToken($token);
Security::isRoleAdmin($token);

echo View::render('provider_create', 'backoffice');


