<?php
require __DIR__ . '/bootstrap.php';

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Show Strip database</title>
    <link rel='stylesheet' href='style.css' type="text/css">
</head>
<body>
<div id="container">
<?php
$held = isset($_POST['held']) ? $_POST['held'] : "";
echo "<a href=\"index.php\">home</a><p>";

$container = new Container($configuration);
$stripboekLader = $container->getStripboekLader();
//$tekenaarLader = $container->getTekenaarLader();
//$stripboeken = $container->getStripboekLader()->getStripboeken($held);
$stripboeken = $stripboekLader->getStripboeken($held);

echo $held . "*<br>";

//$stripboek = new Stripboek();
echo "<table>";
foreach ($stripboeken as $stripboek) {
    echo "<tr><td>".$stripboek->getHeld() . "</td><td>" . $stripboek->getTitle() ."</td><td>". $stripboek->getDeel() ."</td><td>".$stripboekLader->findTekenaarInStringById($stripboek->getTekenaar()) ."</td><td>" . $stripboek->getJaaruitgave() ."</td><td><a href=strip_bewerk.php>bewerk</a></td><td>verwijder</td><td>copy</td></tr>";
}
echo "</table>";
//var_dump($stripboeken);


?>
</div>
</body>
</html>