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



        $(function() {
            var moveLeft = 30;
            var moveDown = -20;

            $('a.trigger').hover(function(e) {
                $('div#popp').show();
                //.css('top', e.pageY + moveDown)
                //.css('left', e.pageX + moveLeft)
                //.appendTo('body');
            }, function() {
                $('div#popp').hide();
            });

            $('a.trigger').mousemove(function(e) {
                $("div#popp").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
            });

        });

    </script>
   <style type="text/css">
       #popp {
           display: none;
           position: absolute;
           width: 500px;
           padding: 10px;
           background: #eeeeee;
           color: #000000;
           border: 1px solid #1a1a1a;
           font-size: 90%;
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
    echo "<tr><td><a href='#'  class='trigger' onclick='javascript:getHeld(\"".$stripboek->getHeld() . "\");'> ".$stripboek->getHeld() . "</a></td><td>" . $stripboek->getTitle() ."</td><td>". $stripboek->getDeel() ."</td><td>".$stripboekLader->findTekenaarInStringById($stripboek->getTekenaar()) ."</td><td>" . $stripboek->getJaaruitgave() ."</td><td><a href=strip_bewerk.php>bewerk</a></td><td>verwijder</td><td>copy</td></tr>";
}
echo "</table>";
//var_dump($stripboeken);


?>
    <a href="#" id="trigger">test</a>
    <div id="popp" >

    <div id="outputdiv"">
    klik op link!

    </div>
    </di>
</div>
</body>
</html>