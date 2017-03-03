<?php
require __DIR__ . '/bootstrap.php';

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Tonen van gebruikers</title>
    <link rel='stylesheet' href='style.css' type="text/css">
    <script type="text/javascript">
    function confirmDelete(entry){
    return confirm("Weet u zeker dat u -- " + entry + " -- wilt verwijderen?");
    }
    </script>
</head>
<body>
<div id="container">
    <?php
    include "menu.php";

    $zoek = isset($_POST['gebruiker']) ? $_POST['gebruiker'] : "";
    if ($zoek=="") {
        $zoek= isset($_GET['all'])?"%":"";
    }
    $container = new Container($configuration);
    $userCrud = $container->getUserCrud();
    $users = $userCrud->getUsers($zoek,"");

    echo "<p>zoekstring = ".$zoek . "*</p><br>";
    echo "<table>";
    echo "<tr><td></td><td class='vet'>gebruiker</td><td class='vet'>hash</td><td class='vet'>rol</td><td class='vet'>actief</td><td class='vet'>email</td><td class='vet'>aanmaakdatum</td><td class='vet'>..</td></tr>";
    foreach ($users as $user) {
        echo "<tr><td>".$user->getUserId()."</td><td>".$user->getUserName() . "</td><td>" . $user->getHash() ."</td><td width=100>". $user->getRole() ."</td><td>". $user->getActive() ."</td><td>". $user->getEmail() ."</td><td>". $user->getCreationDate() ."</td><td><a href='gebruiker_bewerk.php?ID={$user->getUserId()}'>bewerk</a>/<a onClick=\"return confirmDelete('{$user->getUserName()}');\" href=\"gebruiker_verwijder.php?id={$user->getUserId()}\">verwijder</td></tr>";
    }
    echo "</table>";
    ?>
</div>
</body>
</html>