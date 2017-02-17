<!DOCTYPE html>
<?php
$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>
<html>
<body>

<?php
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
}
?>
879e9d96a6635ea88486705a9192696e9c
879e9d967a8f778985a47498a172667976
879e9d9692989b717c828b5b724e6f6590

879e9d968583777061898a7492647e5898
879e9d96976472818667538e72837b628c

</body>
</html>