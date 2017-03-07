<?php
require __DIR__ . '/bootstrap.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Wijzig tekenaar/schrijver</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body>
<?php
$id="";
$id= isset($_GET['ID']) ? $_GET['ID']:"";
$bewaren = isset($_POST['bewaren'])?$_POST['bewaren']:"";

$zoek="";
include "menu.php";

$container=new Container($configuration);
$dataLader= $container->getTekenaarLader();

echo "<br>";

echo "<table><form name='tekenaar' action='tekenaar_bewerk.php' method='post'> ";

if ($bewaren) {
    $id=isset($_POST['id']) ? $_POST['id'] : "";
    echo "<tr><td colspan='2'>bewaren post[{$id}]</td> </tr>";
    echo "<tr><td colspan='2'>".$id." * ".$_POST['achternaam']." * ".$_POST['voornaam']." * ".$_POST['alias']." * ".$_POST['gbdatum']." * ".$_POST['gbland']." * ".$_POST['rol']." * ".$_POST['image']." * ".$_POST['opmerking']."</td> </tr>";
    $verander= $dataLader->createOrUpdateTekenaar($id,$_POST['achternaam'],$_POST['voornaam'],$_POST['alias'],$_POST['gbdatum'],$_POST['gbland'],$_POST['rol'],$_POST['image'],$_POST['opmerking']);
    //header ( "Location: tekenaar_view.php?letter=$letter" );
}
echo "get".$id;
$velden=$dataLader->getVeldenTekenaar();
$tekenaars = $dataLader->getTekenaars($zoek,$id);
$teken=new Tekenaar();
if ($tekenaars != null) $teken=$tekenaars[0];

echo "<tr><td>{$velden[0]}</td><td>" . $teken->getId() . "</td></tr>";
echo "<tr><td>{$velden[1]}</td><td><input name=achternaam value='" . str_replace("'","&#39;",$teken->getAchterNaam()) . "'></td></tr>";
echo "<tr><td>{$velden[2]}</td><td><input name=voornaam value='" . $teken->getVoorNaam() . "'></td></tr>";
echo "<tr><td>{$velden[3]}</td><td><input name=alias value='" . $teken->getAlias() . "'></td></tr>";
echo "<tr><td>{$velden[4]}</td><td><input name=gbdatum value='" . $teken->getGeboorteDatum() . "'></td></tr>";
echo "<tr><td>{$velden[5]}</td><td><input name=gbland value='" . $teken->getGeboorteLand() . "'></td></tr>";

$select1 = $select2 = $select3 = "";
if ($teken->getRol() == TekenaarLader::TYPE_TEKENAAR) $select1 = "selected";
elseif ($teken->getRol() == TekenaarLader::TYPE_SCHRIJVER) $select2 = "selected";
elseif ($teken->getRol() == TekenaarLader::TYPE_BEIDE) $select3 = "selected";
echo "<tr><td>{$velden[6]}</td><td><select name=rol><option value=" . TekenaarLader::TYPE_TEKENAAR . " {$select1}>tekenaar</option>";
echo "<option value=" . TekenaarLader::TYPE_SCHRIJVER . " {$select2}>schrijver</option><option value=" . TekenaarLader::TYPE_BEIDE . " {$select3}>beide</option>";
echo "</select></td></tr>";

echo "<tr><td>{$velden[7]}</td><td><input name=image value='" . $teken->getImage() . "'></td></tr>";
echo "<tr><td>{$velden[8]}</td><td><textarea name=opmerking>" . $teken->getOpmerking(). "</textarea></td></tr>";


echo "<tr><td colspan='2'><input type='hidden' name='id' value='{$teken->getId()}'><input type=submit name='bewaren' value=bewaar></td> </tr>";

echo "</table></form>";

?>
<p><a href="tekenaar_bewerk.php">Tekenaar toevoegen</a> </p>

</body>
</html>