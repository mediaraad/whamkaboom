<?php


$devar = $_POST["devar"];
$devar2 = $_POST["devar2"];


$back['terug1'] =  $devar +5;
$back['terug2'] =  $devar2 *5;
$back['error'] = false;

echo json_encode($back);
exit;