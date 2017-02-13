<?php
session_start();

include "functions.php"; // functies

if ( !empty($herinner) && empty ( $login ) ) {
    $last_login = $login = $herinner;
}
if ( ! empty ( $last_login ) ) $login = "";

// calculate path for cookie
//$ptr = strstr ( $PHP_SELF, "login.php" );
$cookie_path = "/";
/*
srand((double) microtime() * 1000000);
$salt = chr( rand(ord('A'), ord('z'))) . chr( rand(ord('A'), ord('z')));
$encoded_login = encode_string ( $login . "|" . crypt($password, $salt) );
*/
//SetCookie ( "eenkoekie", $encoded_login,time()-3600);
setcookie ( "eenkoekie", "",time() + ( 12 * 3600 * 1 ), $cookie_path );
$_SESSION=array();
session_unset();
session_destroy();
//unset ($_COOKIE['eenkoekie']);
Header ( "Location:login.php" );
?>
