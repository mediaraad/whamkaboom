<?php
require __DIR__ . '/bootstrap.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Wijzig uitgever</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body>
<?php
$id = "";
$id = isset($_GET['ID']) ? $_GET['ID'] : "";
$bewaren = isset($_POST['bewaren']) ? $_POST['bewaren'] : "";
$zoek = "";

include "menu.php";


$container = new Container($configuration);
$uitgeverLader = $container->getUitgeverLader();

echo "<br>";

echo "<table><form name='uitgever' action='uitgever_bewerk.php' method='post'> ";

if ($bewaren) {
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    echo "<tr><td colspan='2'>bewaren post[{$id}]</td> </tr>";
    echo "<tr><td colspan='2'>" . $id . " * " . $_POST['achternaam'] . " * " . $_POST['voornaam'] . " * " . $_POST['alias'] . " * " . $_POST['gbdatum'] . " * " . $_POST['gbland'] . " * " . $_POST['rol'] . " * " . $_POST['image'] . " * " . $_POST['opmerking'] . "</td> </tr>";
    $verander = $uitgeverLader->createOrUpdateUitgever($id, $_POST['achternaam'], $_POST['voornaam'], $_POST['alias'], $_POST['gbdatum'], $_POST['gbland'], $_POST['rol'], $_POST['image'], $_POST['opmerking']);
    //header ( "Location: tekenaar_view.php?letter=$letter" );
}

echo "get id: " . $id;
//$velden=$dataLader->getVeldenUitgever();
$uitgever = $uitgeverLader->getUitgeverByID($id);

/*
echo '<pre>';
print_r($uitgever);
echo '</pre>';
*/

/*tijdelijk*/
$velden[0] = 'ID';
$velden[1] = 'Naam';
$velden[2] = 'Adres';
$velden[3] = 'Opmerking';
/****/

//$uitgever = new Uitgever();
// if ($uitgevers != null) $uitgever=$uitgevers[0];

echo "<tr><td>{$velden[0]}</td><td>" . $uitgever->getId() . "</td></tr>";
echo "<tr><td>{$velden[1]}</td><td><input name='naam' value='" . $uitgever->getNaam() . "'></td></tr>";
echo "<tr><td>{$velden[2]}</td><td><input name='voornaam' value='" . $uitgever->getAdres() . "'></td></tr>";
echo "<tr><td>{$velden[3]}</td><td><input name='opmerking' value='" . $uitgever->getOpmerking() . "'></td></tr>";
echo "<tr><td colspan='2'><input type='hidden' name='id' value='{$uitgever->getId()}'>
<input type=submit name='bewaren' value=bewaar></td> </tr>";

echo "</table></form>";

?>
<p><a href="uitgever_bewerk.php">Uitgever toevoegen</a></p>

</body>
</html>