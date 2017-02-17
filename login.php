<?php
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
            SetCookie ( "eenkoekie", $hash,time() + ( 12 * 3600 * 1 ), "/" );
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
<?php
echo " <br>Cookie[eenkoekie]: ".$_COOKIE['eenkoekie'];

?>
</body>
</html>