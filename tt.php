<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <script type="text/javascript" src="js3/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js3/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript">

        $(function () {
            $('#test').click(function () {
                var a = 2
                var b = 5
                var output = doajax(a, b);
                 //console.log("consoll: "+output);
                // do something
            });

            function doajax( devar, devar2 ) {
                var back_error;
                $.ajax({
                    url: 'ajax_dowat.php',
                    type: "POST",
                    async: true,
                    dataType: "json",
                    data: {
                        'devar': devar,
                        'devar2': devar2
                    }
                }).done(function (back) {


                    $("#outputdiv").html(back.terug1);
                    $("#outputdiv1").html(back.terug2);

                    console.log(back);
                    return back;

                    /*
                    if (back.error) {
                        back_error = back.error;
                    } else {


                    }*/
                });
                //
               // return back_error;
            }



        });


    </script>

</head>
<body>
<div id="test">
   DIVVVVV
</div>

<div id="outputdiv">
OUTPUT1
</div>

<div id="outputdiv1">
    OUTPUT2
</div>


</body>
</html>