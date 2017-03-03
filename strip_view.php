<?php
require __DIR__ . '/bootstrap.php';

?>

<html>
<head>
    <meta charset="utf-8">
    <title>Show Strip database</title>
    <link rel='stylesheet' href='style.css' type="text/css">

    <script type="text/javascript" src="js3/jquery-3.1.1.min.js"></script>
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

        function popup() { popp.style.display="block"; }
        function close() {
            var e = document.getElementById('popp');
            e.style.display="none";
        }
     

    </script>
   <style type="text/css">
       #popp {
           position:absolute; top:233px; left: 50%;
           background-color:#eee0ee;
           width: 500px;
           text-align: left;
           padding:0px;
           border:1px solid #000;
           z-index: 902;
       }
       #outputdiv {
           background-color: #eeeeee; border:1px solid red;
           width: 500px;
           text-align: left;
           padding: 3px;
           margin-top: 20px;

           z-index: 9002;
       }
   </style>
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
    echo "<tr><td><a href='#' onclick='popup();javascript:getHeld(\"".$stripboek->getHeld() . "\");'> ".$stripboek->getHeld() . "</a></td><td>" . $stripboek->getTitle() ."</td><td>". $stripboek->getDeel() ."</td><td>".$stripboekLader->findTekenaarInStringById($stripboek->getTekenaar()) ."</td><td>" . $stripboek->getJaaruitgave() ."</td><td><a href=strip_bewerk.php>bewerk</a></td><td>verwijder</td><td>copy</td></tr>";
}
echo "</table>";
//var_dump($stripboeken);


?>
    
    <div id="popp"  style="display: none;">
        <a href=""></a>
    <div id="outputdiv"">
aa

    </div>
    </di>
</div>
</body>
</html>