<?php
require __DIR__ . '/bootstrap.php';

session_start();

$login=isset($_POST['login'])? $_POST['login']:"";
$password=isset($_POST['password'])? $_POST['password']:"";
$herinner =isset($_COOKIE['herinner'])?  $_COOKIE['herinner']:"";

if ( !empty($herinner) && empty ($login) )  $last_login = $login = $herinner;
if ( !empty ($last_login) ) $login = "";

$container= new Container($configuration);
$user= $container->getUserLogin();

    if ( ! empty ( $login ) && ! empty ( $password ) ) {
        if ( $user->checkUser ( $login, $password ) ) {
            $_SESSION['session']=session_id();
            $_SESSION['ingelogd']=true;
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
echo $_SESSION['session'];
?>
</body>
</html>