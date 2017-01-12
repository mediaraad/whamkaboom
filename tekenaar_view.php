<?php
require __DIR__ . '/bootstrap.php';

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Tonen van tekenaars/schrijvers</title>
    <link rel='stylesheet' href='style.css' type="text/css">
</head>
<body>
<div id="container">
    <?php
    $zoek = isset($_POST['tekenaar']) ? $_POST['tekenaar'] : "";
    echo "<a href=\"index.php\">home</a><p>";

    $container = new Container($configuration);
    $tekenaarLader = $container->getTekenaarLader();
    $tekenaars = $tekenaarLader->getTekenaars($zoek);
    //var_dump($tekenaars); die;
    echo $zoek . "*<br>";

    echo "<table>";
    foreach ($tekenaars as $teken) {
        echo "<tr><td>".$teken->getAchterNaam() . "</td><td>" . $teken->getVoorNaam() ."</td><td width=100>". $teken->getAlias() ."</td><td>". $teken->getGeboorteDatum() ."</td><td>". $teken->getGeboorteLand() ."</td><td>". $teken->getRol() ."</td><td width=250>". $teken->getOpmerking() ."</td></tr>";
    }
    echo "</table>";
    //var_dump($tekenen);


    ?>
</div>
</body>
</html>