<?php
/*
require_once __DIR__.'/Stripboek.php';
require_once __DIR__.'/StripboekLader.php';
require_once __DIR__.'/Tekenaar.php';
require_once __DIR__.'/TekenaarLader.php';
require_once __DIR__.'/Container.php';
*/

spl_autoload_register(function($className) {
    $path = __DIR__.'/'.$className.'.php';
    if (file_exists($path)) {
        require $path;
    }
});


$configuration = array(
'db_dsn' => 'mysql:host=localhost;dbname=strip_db',
'db_user' => 'root',
'db_pass' => 'buhbuh'
);
