<?php
require __DIR__ . '/bootstrap.php';

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Tonen van tekenaars/schrijvers</title>
    <link rel='stylesheet' href='style.css' type="text/css">
    <script type="text/javascript">
        function confirmDelete(entry) {
            return confirm("Weet u zeker dat u -- " + entry + " -- wilt verwijderen?");
        }
    </script>
</head>
<body>
<div id="container">
    <?php
    include "menu.php";

    $zoek = isset($_POST['tekenaar']) ? $_POST['tekenaar'] : "";

    $container = new Container($configuration);
    $tekenaarLader = $container->getTekenaarLader();
    $tekenaars = $tekenaarLader->getTekenaars($zoek);

    echo $zoek . "*<br>";

    echo "<table>";
    echo "<tr><td class='vet'>naam</td><td class='vet'>voornaam</td><td class='vet'>alias</td><td class='vet'>geboren</td><td class='vet'>land</td><td class='vet'>rol</td><td class='vet'>opmerking</td><td class='vet'>..</td></tr>";
    foreach ($tekenaars as $teken) {
        echo "<tr><td>" . $teken->getAchterNaam() . "</td><td>" . $teken->getVoorNaam() . "</td><td width=100>" . $teken->getAlias() . "</td><td>" . $teken->getGeboorteDatum() . "</td><td>" . $teken->getGeboorteLand() . "</td><td>" . $teken->getRol() . "</td><td>";
        if ($teken->getOpmerking() != "") echo "Er is een opmerking";
        echo "</td><td><a href='tekenaar_bewerk.php?ID={$teken->getId()}'>bewerk</a>/<a onClick=\"return confirmDelete('{$teken->getAchterNaam()}');\" href=\"tekenaar_verwijder.php?id={$teken->getId()}\">verwijder</td></tr>";
    }
    echo "</table>";
    //var_dump($tekenen);


    ?>
</div>
</body>
</html>