<?php
ini_set('session.gc_maxlifetime',10800);
ini_set('session.gc_probability',1);
ini_set('session.gc_divisor',100);
ini_set('session.save_path','/var/www/session');
session_start();

if (isset($_COOKIE['eenkoekie'])) {
    //unset($_COOKIE['eenkoekie']);
    setcookie ( "eenkoekie",'',1,"/");
    setcookie ( PHPSESSID,'',1,"/");

}

$_SESSION=array();
//session_unset();
session_destroy();

header ( "Location:login.php" );
?>
