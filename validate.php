<?php
session_start();
$sessionFound = session_id();

//$container= new Container($configuration);
//$user= $container->getUserLogin();

if($_SESSION['ingelogd']==false || ($_SESSION['ingelogd']=='')) {
    // sessie verlopen!
    session_unset();
    session_destroy();
    header('location: login.php');
    }
/* user toevoer */
if ($_SESSION['ingelogd']==true && $_SESSION['session']!=$sessionFound) {
    session_unset();
    session_destroy();
    header('location: login.php');

}

/* Extra check up user ???
          if ($user->userValidCrypt($login, $cryptpw)) {
*/
