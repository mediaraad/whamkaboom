<?php
/* Session lifetime of 3 hours
 * http://stackoverflow.com/questions/5238136/increase-php-session-time
 */
ini_set('session.gc_maxlifetime',10800);
ini_set('session.gc_probability',1);
ini_set('session.gc_divisor',100);
ini_set('session.save_path','/var/www/session');

session_start();
$koekie = $_COOKIE['koekie'];

$container= new Container($configuration);
$user= $container->getUserLogin();

if($_SESSION['ingelogd']==false || ($_SESSION['ingelogd']=='')) {
    session_unset();
    session_destroy();
    header('location: login.php');
    }

$ipAddress = $_SERVER['REMOTE_ADDR'];
if (!password_verify($ipAddress,$koekie)) {
    session_unset();
    session_destroy();
    header('location: login.php');
}

/*
 * http://stackoverflow.com/questions/6360093/how-to-set-lifetime-of-session
 *
//On login
setcookie('sessid', $sessionid, 604800);      // One week or seven days
setcookie('sesshash', $sessionhash, 604800);  // One week or seven days
// And save the session data:
saveSessionData($sessionid, $sessionhash, serialize($_SESSION)); // saveSessionData is your function


user return
if (isset($_COOKIE['sessid'])) {
    if (valide_session($_COOKIE['sessid'], $_COOKIE['sesshash'])) {
        $_SESSION = unserialize(get_session_data($_COOKIE['sessid']));
    } else {
        // Dont validate the hash, possible session falsification
    }
}*/

/* Extra check up user ???
          if ($user->userValidCrypt($login, $cryptpw)) {
*/
