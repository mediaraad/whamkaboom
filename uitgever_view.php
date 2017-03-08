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

    $zoek = isset($_POST['uitgever']) ? $_POST['uitgever'] : "";

    $container = new Container($configuration);
    $uitgeverLader = $container->getUitgeverLader();
    $uitgevers = $uitgeverLader->getUitgever($zoek);

    echo $zoek . "*<br>";

    echo "<table>";
    echo "<tr>
        <td class='vet'>naam</td>
        <td class='vet'>adres</td>
         <td class='vet'>opmerking</td>
         <td class='vet'>..</td></tr>";


    foreach ($uitgevers as $uitgever) {
        echo "<tr>
        <td>" . $uitgever->getNaam() . "</td>
        <td>" . $uitgever->getAdres() . "</td>
        <td width=100>" . $uitgever->getOpmerking() . "</td>
        ";

        if ($uitgever->getOpmerking() != "") echo "Er is een opmerking";
        echo "</td><td><a href='uitgever_bewerk.php?ID={$uitgever->getId()}'>bewerk</a>/<a onClick=\"return confirmDelete('{$uitgever->getNaam()}');\" href=\"uitgever_verwijder.php?id={$uitgever->getId()}\">verwijder</td></tr>";
    }

    echo "</table>";
    //var_dump($tekenen);
    ?>

</div>
</body>
</html>