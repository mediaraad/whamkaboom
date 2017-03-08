<?php
//require __DIR__ . '/bootstrap.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Strip collectie: uitgevers</title>
    <link rel='stylesheet' href='style.css' type="text/css">
</head>

<body>
<div id="container">
    <?php
    include "menu.php";
    ?>

    <h3>Uitgevers:</h3>

    <form action="uitgever_view.php" method="post"> Kies een uitgever
        <input name="uitgever"> <input class=home type="submit" value="ok" name=put>
    </form>

<p><a href="uitgever_tabel.php">Uitgeverstabel</a> </p>
<p><a href="uitgever_bewerk.php">Uitgever toevoegen</a> </p>
</div>
</body>
</html>