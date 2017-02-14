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

if ($_SESSION['ingelogd']==true && $_SESSION['session']!=$sessionFound) {
    session_unset();
    session_destroy();
    header('location: login.php');

}

/*
          if ($user->userValidCrypt($login, $cryptpw)) {
                //do_debug ( "User not logged in; redirecting to login page" );
                Header ("Location:login.php" );

            }
            //else echo " ga verder $login $cryptpw ";
        } // einde if
    } // einde else
} // einde else

if ($sessionNotFound) {
    Header ("Location:login.php" );
    exit;
}*/
