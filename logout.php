<?php
session_start();

if (isset($_COOKIE['eenkoekie'])) {
    unset($_COOKIE['eenkoekie']);
    setcookie ( "eenkoekie", '',1,"/");

}


$_SESSION=array();
session_unset();
session_destroy();

header ( "Location:login.php" );
?>
