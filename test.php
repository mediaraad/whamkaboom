<?php
function requireSSL() {
    if($_SERVER["HTTPS"] != "on") {
//header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
//exit();
        echo "Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
    }
}

function sec_session_start() {
    $session_name = 'sec_session_id'; // Set a custom session name
    $secure = true; // Set to true if using https.
    $httponly = true; // This stops javascript being able to access the session id.
    ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies.
    $cookieParams = session_get_cookie_params(); // Gets current cookies params.
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
    session_name($session_name); // Sets the session name to the one set above.
    session_start(); // Start the php session
    //session_regenerate_id(true); // regenerated the session, delete the old one.

    var_dump($cookieParams);


}



//requireSSL();
sec_session_start();

if(true == true) {
$_SESSION['origURL'] = $_SERVER['REQUEST_URI'];
    $_SESSION['hallo']= "hallo";
//header('Location: https://www.example.com/login.php');
    echo "hallo ".$_SESSION['origURL'];
//exit();
}
var_dump($_COOKIE);
var_dump($_SESSION);

foreach ($_SESSION as $key=>$val)
    echo $key." -> ".$val."<br/>";






