<?php
//require __DIR__ . '/bootstrap.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Strip collectie: tekenaars</title>
    <link rel='stylesheet' href='style.css' type="text/css">
</head>

<body>
<div id="container">
    <?php
    include "menu.php";
    ?>

    <h3>Tekenaars:</h3>

    <form action="tekenaar_view.php" method="post"> Kies een tekenaar
        <input name="tekenaar"> <input class=home type="submit" value="ok" name=put>
    </form>

<p><a href="tekenaar_tabel.php">Tekenaarstabel</a> </p>
<p><a href="tekenaar_bewerk.php">Tekenaar toevoegen</a> </p>
</div>
</body>
</html>