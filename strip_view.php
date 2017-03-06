<?php
require __DIR__ . '/bootstrap.php';

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Show Strip database</title>
    <link rel='stylesheet' href='style.css' type="text/css">
    <script type="text/javascript" language="javascript" src="domTT/domLib.js"></script>
    <script type="text/javascript" language="javascript" src="domTT/domTT.js"></script>
    <script type="text/javascript" language="javascript" src="domTT/domTT_drag.js"></script>
    <script>
        var domTT_styleClass = 'domTTOverlib';
    </script>
</head>

    <script type="text/javascript" src="js3/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js3/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript">
        function getHeld( deVar ) {
            var back_error;
            $.ajax({
                url: 'ajax_getheld.php',
                type: "POST",
                async: true,
                dataType: "json",
                data: {
                    deVar: deVar
                }
            }).done(function (response) {


                var trHtml="";
                $.each(response, function(key, value) {
                        trHtml += value.held + " - "+ value.titel +"<br>";
                        console.log(value.held);
                    }
                );
                $("#outputdiv").html(trHtml);
                //return response["label"];
                /*
                 if (response.error) {
                 back_error = response.error;
                 } else {
                 }*/
            });
        }


    </script>

</head>
<body>
<div id="container">
<?php
$held = isset($_POST['held']) ? $_POST['held'] : "";
echo "<a href=\"index.php\">home</a><p>";

$container = new Container($configuration);
$stripboekLader = $container->getStripboekLader();
$stripboeken = $stripboekLader->getStripboeken($held);

echo $held . "*<br>";

//$stripboek = new Stripboek();
echo "<table>";
foreach ($stripboeken as $stripboek) {
    echo "<tr><td><a href='#' onmouseover=\"domTT_activate(this, event, 'content', 'This tip stays put when active');\" onclick=\"return makeFalse(domTT_activate(this, event, 'caption', 'Verschillende titels', 'content', 'hallo', 'type', 'sticky', 'closeLink', '[close]', 'draggable', true));\">" .$stripboek->getHeld() . "</a></td><td>" . $stripboek->getTitle() ."</td><td>". $stripboek->getDeel() ."</td><td>".$stripboekLader->findTekenaarInStringById($stripboek->getTekenaar()) ."</td><td>" . $stripboek->getJaaruitgave() ."</td><td><a href=strip_bewerk.php>bewerk</a></td><td>verwijder</td><td>copy</td></tr>";
}
echo "</table>";
//var_dump($stripboeken);


?>
    <a href="#" id="trigger">test</a>
    <div id="popp" >


    klik op link!


    </di>
</div>
</body>
</html>