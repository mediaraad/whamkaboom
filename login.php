<?php
include "functions.php";

$login=isset($_POST['login'])? $_POST['login']:"";
$password=isset($_POST['password'])? $_POST['password']:"";
$herinner =isset($_COOKIE['herinner'])?  $_COOKIE['herinner']:"";
if ( !empty($herinner) && empty ($login) ) {
    $last_login = $login = $herinner;
}
$remember='yes';
if ( !empty ($last_login) ) $login = "";

// calculate path for cookie
//$ptr = strstr ( $_SERVER['PHP_SELF'], "login.php" );
$cookie_path = "/";

    print($login." ".$password."]".$_COOKIE['herinner']);
    if ( ! empty ( $login ) && ! empty ( $password ) ) {
        if ( user_valid_login ( $login, $password ) ) { // in functions.php
            // user_load_variables ( $login, "" ); // in functions.php
            // set login to expire in 365 days
            srand((double) microtime() * 1000000);
            $salt = chr( rand(ord('A'), ord('z'))) . chr( rand(ord('A'), ord('z')));
            $encoded_login = encode_string ( $login . "|" . crypt($password, $salt) ); // in functions.php
            if ( $remember == "yes" ) SetCookie ( "eenkoekie", $encoded_login,time() + ( 12 * 3600 * 1 ), $cookie_path );
            else SetCookie ( "eenkoekie", $encoded_login, 0, $cookie_path );
            if ( $remember == "yes" ) SetCookie ( "herinner", $login,time() + ( 24 * 3600 * 120), $cookie_path );
            else SetCookie ( "herinner", $login, 0, $cookie_path );
            echo "hallo";
            Header ("Location:index.php" );
            //echo $encoded_login;
        }
        else $error="Verkeerde combinatie";

    }
    else print "HH";


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
if (isset($_COOKIE['eenkoekie'])) echo "<br>".$_COOKIE['eenkoekie'];
?>

</body>
</html>