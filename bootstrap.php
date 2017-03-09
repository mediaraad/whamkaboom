<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

spl_autoload_register(function($className) {
    $path = __DIR__.'/lib/'.$className.'.php';
    if (file_exists($path)) {
        require $path;
    }
});


$configuration = array(
'db_dsn' => 'mysql:host=localhost;dbname=strip_db',
'db_user' => 'root',
'db_pass' => 'buhbuh'
);
