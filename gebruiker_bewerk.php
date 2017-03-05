<?php
require __DIR__ . '/bootstrap.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Wijzig gebruiker</title>
    <link rel='stylesheet' href='style.css'>
</head>
<body>

<?php

$id= isset($_GET['ID']) ? $_GET['ID']:"";
$bewaren = isset($_POST['bewaren'])?$_POST['bewaren']:"";

$zoek="";
include "menu.php";

$container=new Container($configuration);
$userCrud= $container->getUserCrud();

echo "<p>&nbsp;<br><table><form name='gebruiker' action='gebruiker_bewerk.php' method='post'> ";

if ($bewaren) {
    $id=isset($_POST['id']) ? $_POST['id'] : "";

    //TODO: voorwaarden voor naam,rol,actief,email, datum, hash/password
    if (isset($_POST['wachtwoord'])) $hash= password_hash($_POST['wachtwoord'],PASSWORD_DEFAULT);
    else $hash=isset($_POST['hash'])?$_POST['hash']:password_hash("grapje",PASSWORD_DEFAULT);
    $idLast= $userCrud->createOrUpdateUser($id,$_POST['naam'],$hash,$_POST['rol'],$_POST['actief'],$_POST['email'],$_POST['datum']);
    if ($id=="") $id=$idLast;
    //header ( "Location: gebruiker_view.php" );
}


$users = $userCrud->getUsers($zoek,$id);
$user=new Users();
if ($users != null) $user=$users[0];

echo "<tr><td>id</td><td>" . $user->getUserId() . "</td></tr>";
echo "<tr><td>naam</td><td><input name=naam value='" . str_replace("'","&#39;",$user->getUserName()) . "'></td></tr>";
if ($id=="") echo "<tr><td>wachtwoord</td><td><input type='text' name='wachtwoord'></td></tr>";
else echo "<tr><td>hash</td><td>" . $user->getHash() . "</td></tr><input type='hidden' name='hash' value='{$user->getHash()}'>";

$select1 = $select2 = "";
if ($user->getRole() == UserCrud::TYPE_ROL_GAST) $select1 = "selected";
elseif ($user->getRole() == UserCrud::TYPE_ROL_ADMIN) $select2 = "selected";
echo "<tr><td>rol</td><td><select name=rol><option value=" . UserCrud::TYPE_ROL_GAST . " {$select1}>gast</option>";
echo "<option value=" . UserCrud::TYPE_ROL_ADMIN . " {$select2}>admin</option>";
echo "</select></td></tr>";

$sel1 = $sel2 = "";
if ($user->getActive() == UserCrud::TYPE_ACTIVE_NO) $sel1 = "selected";
elseif ($user->getActive() == UserCrud::TYPE_ACTIVE_YES) $sel2 = "selected";
echo "<tr><td>actief</td><td><select name=actief><option value=" . UserCrud::TYPE_ACTIVE_NO . " {$sel1}>niet actief</option>";
echo "<option value=" . UserCrud::TYPE_ACTIVE_YES . " {$sel2}>actief</option>";
echo "</select></td></tr>";

echo "<tr><td>email</td><td><input name=email value='" . $user->getEmail() . "'></td></tr>";



echo "<tr><td>aanmaakdatum</td><td><input name=datum value='" . $user->getCreationDate() . "'></td></tr>";



echo "<tr><td colspan='2'><input type='hidden' name='id' value='{$user->getUserId()}'><input type=submit name='bewaren' value=bewaar></td> </tr>";
if ($bewaren) {
    echo "<tr><td></td><td><strong>{$_POST['naam']}</strong> is bewaard.</td> </tr>";
}

echo "</table></form>";

?>
<p><a href="gebruiker_bewerk.php">Gebruiker toevoegen</a> </p>

</body>
</html>