<?php
session_start();

include "functions.php"; // functies

if ( !empty($herinner) && empty ( $login ) ) {
    $last_login = $login = $herinner;
}
if ( ! empty ( $last_login ) ) $login = "";

$cookie_path = "/";
setcookie ( "eenkoekie", "",time() + ( 12 * 3600 * 1 ), $cookie_path );
$_SESSION=array();
session_unset();
session_destroy();

header ( "Location:login.php" );
?>
