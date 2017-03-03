<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <script type="text/javascript" src="js3/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js3/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript">
        function swapContent(cv) {
            $("#myDiv").html("Put animated gif here").show();
            var url="ajax_tt2script.php";
            $.post(
                url,
                {contentVar:cv},
                function(data){
                    $("#myDiv").html(data).show();
                });
        }


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

                    //console.log(back);
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






    </script>

</head>
<body>
<div id="test" onclick="doajax(1,1)">
   DIVVVVV
</div>

<div id="outputdiv">
    <br>&nbsp;<br>
OUTPUT1
    <br>&nbsp;<br>
</div>

<div id="outputdiv1">
    <br>&nbsp;<br>
    OUTPUT2
    <br>&nbsp;<br>
</div>
<a href="#" onclick="return false" onmousedown="javascript:swapContent('con1');">Content 1</a>
<a href="#" onclick="return false" onmousedown="javascript:swapContent('con2');">Content 2</a>
<a href="#" onclick="return false" onmousedown="javascript:swapContent('con3');">Content 3</a>

<div id="myDiv">

    test
</div>
</body>
</html>