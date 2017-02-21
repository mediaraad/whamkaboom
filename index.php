<?php
require __DIR__ . '/bootstrap.php';
include "validate.php";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Strip collectie</title>
    <link rel='stylesheet' href='style.css' type="text/css">
</head>

<body>
<div id="container">
    <?php
    include "menu.php";
    ?>

    <h3>Stripcollectie:</h3>

    <form action="strip_view.php" method="post"> Kies een held
        <input name="held"> <input class=home type="submit" value="ok" name=put>
    </form>
    <br>
    <form action="tekenaar_view.php" method="post"> Kies een tekenaar
        <input name="tekenaar"> <input class=home type="submit" value="ok" name=put>
    </form>
</div>

<p><hr><br>Een testje:
<?php

$password="12345";
$hash= password_hash($password,PASSWORD_DEFAULT);
echo "<p>hash: ".$hash;
$test=password_verify($password,$hash);
echo "<br>password_verify: ".$test;

echo "<p><strong>sessies</strong><br>";
echo " <br>session_id(): ".session_id();

var_dump($_SESSION);
echo "</p><p><strong>cookies</strong>";
var_dump($_COOKIE);
?>

</body>
</html>