<?php
$sessionNotFound = false;
$eenkoekie = $_COOKIE['eenkoekie'];

if ( empty ($eenkoekie) && empty ($login) ) {
    $sessionNotFound = true;
    }
else {  // Check for cookie...
    if ( ! empty ( $eenkoekie) ) {
        $encoded_login = $eenkoekie;
        if ( empty ( $encoded_login ) ) {  // invalid session cookie
            $sessionNotFound = true;
        }
        else {
            $login_pw = explode('\|', decode_string ($encoded_login)); //in functions.php
            $login = $login_pw[0];
            if (!isset($login_pw[1])) $login_pw[1]= null;
            $cryptpw = $login_pw[1];
            // make sure we are connected to the database for password check
            if (user_valid_crypt($login, $cryptpw)) {
                //do_debug ( "User not logged in; redirecting to login page" );
                Header ("Location:login.php" );
                //echo "sdsd";

            }
            //else echo " ga verder $login $cryptpw ";
        } // einde if
    } // einde else
} // einde else

if ($sessionNotFound) {
    Header ("Location:login.php" );
    exit;
}


?>
