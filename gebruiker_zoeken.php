<?php
//require __DIR__ . '/bootstrap.php';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Strip collectie: gebruikers</title>
    <link rel='stylesheet' href='style.css' type="text/css">
</head>

<body>
<div id="container">
    <?php
    include "menu.php";
    ?>

    <h3>Gebruiker</h3>

    <form action="gebruiker_view.php" method="post"> Zoek een gebruiker
        <input name="gebruiker"> <input class=home type="submit" value="ok" name=put>
    </form>


<p><a href="gebruiker_bewerk.php">Gebruiker toevoegen</a> </p>
</div>
</body>
</html>