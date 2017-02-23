<?php
require __DIR__ . '/bootstrap.php';
include "validate.php";

?>
<!DOCTYPE html>
<html>

<head>
    <title>Strip collectie</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=uft-8">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="js3/jquery-ui-1.12.1/jquery-ui.css">
    <script type="text/javascript" src="js3/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js3/jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script language="javascript">
        $(function() {
            $("#stripheld").autocomplete({
                source: "ajax_autocomplete_stripheld.php",
                minLength: 3
                /*       select: function(event, ui) {
                 var url = ui.item.id;
                 if(url != '#') {
                 location.href = '/blog/' + url;
                 }
                 },
                 html: true, // optional (jquery.ui.autocomplete.html.js required)
                 // optional (if other layers overlap autocomplete list)
                 open: function(event, ui) {
                 $(".ui-autocomplete").css("z-index", 1000);
                 } */
            });

        });
    </script>


</head>

<body>
<div id="container">
    <?php
    include "menu.php";
    ?>

    <h3>Stripcollectie:</h3>

    <form action="strip_view.php" method="post"> Zoek een held
        <input name="held" id=stripheld> <input class=home type="submit" value="ok" name=put  >
    </form>
    <br>
    <form action="tekenaar_view.php" method="post"> Kies een tekenaar
        <input name="tekenaar"> <input class=home type="submit" value="ok" name=put>
    </form>
</div>

<p><hr><br>Een testje:
<?php
echo "<p><strong>sessies</strong><br>";
echo " <br>session_id(): ".session_id();
var_dump($_SESSION);
echo "</p><p><strong>cookies</strong>";
var_dump($_COOKIE);
?>

</body>
</html>