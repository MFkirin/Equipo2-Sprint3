<?php

use App\Core\View;

require_once __DIR__ . '/vendor/autoload.php';

session_start();

echo View::render('index');
