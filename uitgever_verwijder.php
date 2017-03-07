<?php
require __DIR__ . '/bootstrap.php';

$container = new Container($configuration);
$tekenaarLader = $container->getTekenaarLader();
$tekenaarDelete=$tekenaarLader->deleteTekenaar($_GET['id']);

if ($tekenaarDelete)  header('location: tekenaar_tabel.php');
else print ("Niet uitgevoerd!<BR>\n");

?>