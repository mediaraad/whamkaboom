<?php
require __DIR__ . '/bootstrap.php';

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
    <h3>Stripcollectie:</h3>

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