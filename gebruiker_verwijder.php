<?php
require __DIR__ . '/bootstrap.php';

$container = new Container($configuration);
$userCrud = $container->getUserCrud();
$userDelete=$userCrud->deleteUser($_GET['id']);

if ($userDelete)  header('location: gebruiker_view.php?all=1');
//else print ("Niet uitgevoerd!<BR>\n");

?>