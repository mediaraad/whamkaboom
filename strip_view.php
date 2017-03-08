<?php
require __DIR__ . '/bootstrap.php';
$pagina=new Pagina("Toon stripboeken");
?>

<html>
<head>
    <meta charset="utf-8">
    <title><?php echo $pagina->getTitelPagina(); ?></title>
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
                var i=1;
                $.each(response, function(key, value) {
                        trHtml +=i+". "+ value.held + " - "+ value.titel +"<br>";
                        i++;
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


        var mouseX,mouseY,windowWidth,windowHeight;
        var  popupLeft,popupTop;
        $(document).ready(function(){

            $(document).mousemove(function(e){
                mouseX = e.pageX+20;
                mouseY = e.pageY-20;
                //console.log(mouseX);
                //To Get the relative position
                if( this.offsetLeft !=undefined) mouseX = e.pageX - this.offsetLeft;
                if( this.offsetTop != undefined) mouseY = e.pageY; - this.offsetTop;

                if(mouseX < 0) mouseX =10;
                if(mouseY < 0) mouseY = 0;

                windowWidth  = $(window).width()+$(window).scrollLeft();
                windowHeight = $(window).height()+$(window).scrollTop();
            });

            $('.trigger').click(function(){
                $('div#popp').show();
                var popupWidth  = $('div#popp').outerWidth();
                var popupHeight =  $('div#popp').outerHeight();

                if(mouseX+popupWidth > windowWidth) popupLeft = mouseX-popupWidth;
                else popupLeft = mouseX;

                if(mouseY+popupHeight > windowHeight) popupTop = mouseY-popupHeight;
                else popupTop = mouseY;

                if( popupLeft < $(window).scrollLeft()) {
                    popupLeft = $(window).scrollLeft();
                }

                if( popupTop < $(window).scrollTop()){
                    popupTop = $(window).scrollTop();
                }

                if(popupLeft < 0 || popupLeft == undefined) popupLeft = 0;
                if(popupTop < 0 || popupTop == undefined) popupTop = 0;
               /* setTimeout(function() {
                    $( "#popp" ).hide();
                }, 10000);*/
                $('div#popp').offset({top:popupTop,left:popupLeft});
            });


            $("body").click(function(e) {
                if(e.target.id == "popp"){
                    $('div#popp').hide();
                }
            });


        });
        /*

         $(document).mouseup(function (e)
         {
         var container = $("div#popp");

         if (!container.is(e.target) // if the target of the click isn't the container...
         && container.has(e.target).length === 0) // ... nor a descendant of the container
         {
         container.hide();
         }
         });
         */



    </script>
    <style type="text/css">
        #popp {
            display: none;
            position: absolute;
            width: 400px;
            padding: 10px;
            background: #eeeeee;
            color: #000000;
            border: 1px solid #1a1a1a;
            font-size: 90%;
        }
        #outputdiv {
           text-align: left;
            padding: 3px;
            margin-top: 20px;
            z-index: 9002;
        }
        .trigger, #popp {  cursor: pointer;}
        #outputdiv {cursor: text;}
    </style>
</head>
<body>
<div id="container">
    <?php


    $pagina->paginaMenu(2);

    $held = isset($_POST['held']) ? $_POST['held'] : "";


    echo "<a href=\"index.php\">home</a><p>";




    $container = new Container($configuration);
    $stripboekLader = $container->getStripboekLader();
    $stripboeken = $stripboekLader->getStripboeken($held);


    echo "<br>".$held . "*<br>";

    //$stripboek = new Stripboek();
    echo "<table>";
    foreach ($stripboeken as $stripboek) {
        echo "<tr><td><span class='trigger' onclick='javascript:getHeld(\"".$stripboek->getHeld() . "\");'> ".$stripboek->getHeld() . "</span></td><td>" . $stripboek->getTitle() ."</td><td>". $stripboek->getDeel() ."</td><td>".$stripboekLader->findTekenaarInStringById($stripboek->getTekenaar()) ."</td><td>" . $stripboek->getJaaruitgave() ."</td><td><a href=strip_bewerk.php>bewerk</a></td><td>verwijder</td><td>copy</td></tr>";
    }
    echo "</table>";
    //var_dump($stripboeken);


    ?>

    <div id="popp" >
        [sluit]
        <div id="outputdiv"">


    </div>
    </di>

</div>
<?php
$pagina->footer();
?>
</body>
</html>