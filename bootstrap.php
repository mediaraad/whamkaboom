<?php
/*
require_once __DIR__.'/Stripboek.php';
require_once __DIR__.'/StripboekLader.php';
require_once __DIR__.'/Tekenaar.php';
require_once __DIR__.'/TekenaarLader.php';
require_once __DIR__.'/Container.php';
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);



spl_autoload_register(function($className) {
    $path = __DIR__.'/lib/'.$className.'.php';
    if (file_exists($path)) {
        require $path;
    }
});


$configuration = array(
'db_dsn' => 'mysql:host=localhost;dbname=strips',
'db_user' => 'whamkaboom',
'db_pass' => 'okidoki'
);
