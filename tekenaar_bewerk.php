<?php
require __DIR__ . '/bootstrap.php';

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Wijzig tekenaar/schrijver</title>
    <link rel='stylesheet' href='style.css'>
    <style>
        <!--
        table {border-collapse: collapse; border: solid 1px #881f44;}
        td {padding:3px;}
        -->
    </style>
</head>
<body>
<?php
$id= isset($_GET['ID']) ? $_GET['ID']:"";
$zoek="";
include "menu.php";

$container=new Container($configuration);
$veldenLader= $container->getTekenaarLader();
$velden=$veldenLader->getVeldenTekenaar();
$tekenaars = $veldenLader->getTekenaars($zoek,$id);
echo "<br>";

echo "<table><form name='tekenaar' action='tekenaar_bewerk.php'> ";

foreach ($tekenaars as $teken) {
    echo "<tr><td>{$velden[0]}</td><td>".$teken->getId() . "</td></tr>";
    echo "<tr><td>{$velden[1]}</td><td><input name=achternaam value='".$teken->getAchterNaam() . "'></td></tr>";
    echo "<tr><td>{$velden[2]}</td><td><input name=achternaam value='" . $teken->getVoorNaam() ."'></td></tr>";
    echo "<tr><td>{$velden[3]}</td><td><input name=achternaam value='". $teken->getAlias() ."'></td></tr>";
    echo "<tr><td>{$velden[4]}</td><td><input name=achternaam value='". $teken->getGeboorteDatum() ."'></td></tr>";
    echo "<tr><td>{$velden[5]}</td><td><input name=achternaam value='". $teken->getGeboorteLand() ."'></td></tr>";
    echo "<tr><td>{$velden[6]}</td><td><input name=achternaam value='". $teken->getRol() ."'></td></tr>";
    echo "<tr><td>{$velden[7]}</td><td><input name=achternaam value='". $teken->getImage() ."'></td></tr>";
    echo "<tr><td>{$velden[8]}</td><td><textarea name=achternaam> ". $teken->getOpmerking()."</textarea></td></tr>";
}
echo "</table></form>";

?>


</body>
</html>