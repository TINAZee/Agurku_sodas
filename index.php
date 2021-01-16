<?php
define('DOOR_BELL', 'ring');
define('INSTALL_FOLDER', '/BIT_KURSAI_PHP/Agurku_sodas/');
// define('URL', 'http://localhost//BIT_KURSAI_PHP/Agurku_sodas/');
define('DIR', __DIR__);

include __DIR__ . '/bootstrap.php';

TINAZee\App::route();

// _d($uri);

$page = preg_replace('/[^\d]/','',$_SERVER['REQUEST_URI']);