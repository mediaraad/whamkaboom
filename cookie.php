<!DOCTYPE html>
<?php
$cookie_name = "user";
$cookie_value = "Sens";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>
<html>
<head><title>test met cookies</title></head>
<body>

<?php
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}


unset($_COOKIE[$cookie_name]);
setcookie ( $cookie_name,'',1,"/");

if(!isset($_COOKIE[$cookie_name])) {
    echo "<p>Cookie named '" . $cookie_name . "' is not set!";
} else {
echo "Cookie '" . $cookie_name . "' is set!<br>";
echo "Value is: " . $_COOKIE[$cookie_name];
}
?>


</body>
</html>