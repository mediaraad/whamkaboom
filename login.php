<?php
//ini_set('session.gc_maxlifetime', 3600);  // server should keep session data for AT LEAST 1 hour
//session_set_cookie_params(3600, "/");     // each client should remember their session id for EXACTLY 1 hour

# Session lifetime of 3 hours
ini_set('session.gc_maxlifetime',10800);

# Enable session garbage collection with a 1% chance of
# running on each session_start()
ini_set('session.gc_probability',1);
ini_set('session.gc_divisor',100);

# Our own session save path; it must be outside the
# default system save path so Debian's cron job doesn't
# try to clean it up. The web server daemon must have
# read/write permissions to this directory.
//session_save_path( '/var/www/session'); // werkt niet!
//ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/session'));
ini_set('session.save_path','/var/www/session');

session_start();

require __DIR__ . '/bootstrap.php';


$login=isset($_POST['login'])? $_POST['login']:"";
$password=isset($_POST['password'])? $_POST['password']:"";
$herinner =isset($_COOKIE['herinner'])?  $_COOKIE['herinner']:"";


if ( !empty($herinner) && empty ($login) )  $last_login = $login = $herinner;
if ( !empty ($last_login) ) $login = "";

$container= new Container($configuration);
$user= $container->getUserLogin();



if ( ! empty ( $login ) && ! empty ( $password ) ) {
    if ( $user->checkUser($login, $password) ) {

        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $hash= password_hash($ipAddress,PASSWORD_DEFAULT);
        SetCookie ( "koekie", $hash,time() + ( 12 * 3600 * 1 ), "/" );
        SetCookie ( "herinner", $login,time() + ( 24 * 3600 * 120), "/" );
        $_SESSION['ingelogd']=true;
        //var_dump($encoded_login);die;
        Header ("Location:index.php" );


    }
    else $error="Fout.";

}
//else print "HH";


?>
<!DOCTYPE html >
<html>
<head>
    <title>Strip collectie</title>
    <SCRIPT LANGUAGE="JavaScript">
        // error check login/password
        function valid_form ( form ) {
            if ( form.login.value.length == 0 || form.password.value.length == 0 ) {
                alert ( "Vul gebruikersnaam en wachtwoord in a.u.b." );
                return false;
            }
            return true;
        }
    </SCRIPT>
    <meta name="generator" content="Sausage Software HotDog Professional 6">
    <meta http-equiv="Content-Type" content="text/html; charset=uft-8">
    <link rel='stylesheet' href='style.css'>
</head>
<body id=home>

<?php
if ( ! empty ( $error ) ) {
    print "<span style=\"color:black;font-weight:bold\">Geen toegang: $error</span><p>\n";

}

?>
Graag inloggen:<P>
<form name="login_form" action="login.php" method="POST" onsubmit="return valid_form(this)">
    id: <input class="home" name="login"  value="<?php if ( isset ( $last_login ) ) echo $last_login;?>" tabindex="1">
    ww: <input class="home" name="password" type="password" tabindex="2"> <input TYPE="hidden" name="remember" value="yes" > <input class="home" type="submit" value="Login" tabindex="3"><br>
</form>
<p>&nbsp;</p>

<br /><br />
<div class="fragment">
    <div>
        <span id='close' onclick='this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); return false;'>x</span>

        <h3>Cookies and Sessions</h3>
        <?php
        echo "<p><strong>sessies</strong><br>";
        echo " <br>session_id(): ".session_id();

        var_dump($_SESSION);
        echo "</p><p><strong>cookies</strong>";
        var_dump($_COOKIE);

        $dateTimeNow=date("Y-m-d H:i:s");
        echo $dateTimeNow;

        ?>
    </div>
</div>



</body>
</html>