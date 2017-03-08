<?php
require __DIR__ . '/bootstrap.php';
include "validate.php";

?>
<!DOCTYPE html>
<html>

<head>
    <title>Strip collectie</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=uft-8">
    <link rel="stylesheet" href="style.css" type="text/css">
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

$password="peterstrip";
$hash= password_hash($password,PASSWORD_DEFAULT);
echo "<p>hash: ".$hash;
$test=password_verify($password,$hash);
echo "<br>password_verify: ".$test;



</div>

<p>&nbsp;<br>
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
        ?>
    </div>
</div>
</body>
</html>