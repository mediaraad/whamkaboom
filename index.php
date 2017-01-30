<?php
require __DIR__ . '/bootstrap.php';

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>Whamkaboom</title>

    <title>Strip collectie</title>

    <link rel='stylesheet' href='style.css' type="text/css">
</head>

<body>



<div id="container">

    <h3>Stripcollectie special edition:</h3>

    <?php
    include "menu.php";

    $password="12345";
    $hash= password_hash($password,PASSWORD_DEFAULT);
    echo $hash;

    $test=password_verify($password,$hash);
    echo "<br>".$test;

    ?>

    <h3>Stripcollectie:</h3>
ffc3c2285b119acbb8ee37d7d285be350edee14a

    <form action="strip_view.php" method="post"> Kies een held
        <input name="held"> <input class=home type="submit" value="ok" name=put>
    </form>
    <br>
    <form action="tekenaar_view.php" method="post"> Kies een tekenaar
        <input name="tekenaar"> <input class=home type="submit" value="ok" name=put>
    </form>
</div>
</body>
</html>